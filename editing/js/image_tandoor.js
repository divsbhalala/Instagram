/* jshint undef: true, unused: true, strict: false, expr: true, maxlen: 120 */
/* globals $ */

var imageTandoor = (function() {
    var jQCanvas = $('#imageCanvas'),

        jQSubtool = $('#slider-holder'),
        jQLeftToolBox = $('#tools'),

        // color picker tool and subtool box
        jQCPSubtool = $('#subtool'),
        jQCPToolBox = $('#tools'),

        filename = "image.png",


        canvasW, canvasH,
        imageWidth = 640,
        imageHeight = 640,


        waterMarkURL = 'images/overlay-img.png', // ** set proper water mark URL

        colorCanvas = {},
        grayCanvas = {},
        wmCanvas = {},
        visualCanv = {},
        beforeWaterMarkImageData,
        helper = {
            _config: {
                translateX: 0,
                translateY: 0,
                zoomLevel: 1,
                edited: false,
                waterMarkLoaded: false,
                overlayZoomLevel: 0
            }
        },

        cpElemId = "cp_point_id_",
        tools = {},
        maxHue = 0.4, //(24 degree)

        // frequently used methods
        mathPow = Math.pow,
        mathSqrt = Math.sqrt,
        mathRound = Math.round,
        mathAbs = Math.abs,
        mathMax = Math.max,
        mathMin = Math.min,

        // frequently used texts
        sbClass = 'subtool_group',
        cpClass = 'color-picker',
        bgColorStr = 'background-color',
        rgbsStr = 'rgba(',
        commaStr = ',',
        closeBrac = ')',
        clickStr = 'click',
        mouseMoveStr = 'mousemove',
        checkedStr = 'checked',
        spanStr = 'span',
        selBtnClass = 'active',
        tableBtnClass = 'add_table_data_botton_class btn btn-primary btn-bordered ',
        sliderClass = 'tool-slider',
        btnTextConf = {
            colorPicker: {
                title: 'Click to add color point',
                tolerance: {
                    txt: 'Adjust tolerance:'
                },
                color: {
                    txt: 'Color:'
                },
                toggleView: {
                    'title': 'Show original image',
                    txt: 'Show original image:'
                },
                desatOuter: {
                    'title': 'Discolour other colors',
                    txt: 'Discolor other colors:'
                }
            }
        };


    /* create the canvas elements */

    //visual canvas
    visualCanv.canvasElem = document.getElementById('imageCanvas');
    visualCanv.jQElem = $(visualCanv.canvasElem);
    visualCanv.ctx = visualCanv.canvasElem.getContext('2d');
    visualCanv._helperCanvasElem = document.createElement('canvas');
    visualCanv._helperCtx = visualCanv._helperCanvasElem.getContext('2d');



    //color
    colorCanvas.canvasElem = document.createElement('canvas');
    colorCanvas.jQElem = $(colorCanvas.canvasElem);
    colorCanvas.ctx = colorCanvas.canvasElem.getContext('2d');
    colorCanvas._helperCanvasElem = document.createElement('canvas');
    colorCanvas._helperCtx = colorCanvas._helperCanvasElem.getContext('2d');

    //gray
    grayCanvas.canvasElem = document.createElement('canvas');
    grayCanvas.jQElem = $(grayCanvas.canvasElem);
    grayCanvas.ctx = grayCanvas.canvasElem.getContext('2d');
    grayCanvas._helperCanvasElem = document.createElement('canvas');
    grayCanvas._helperCtx = grayCanvas._helperCanvasElem.getContext('2d');

    //watermark
    wmCanvas.canvasElem = document.createElement('canvas');
    wmCanvas.jQElem = $(wmCanvas.canvasElem);
    wmCanvas.ctx = wmCanvas.canvasElem.getContext('2d');

    link = document.createElement('canvas')

    //$('.canvas-holder').append($(visualCanv._helperCanvasElem)).append(colorCanvas.jQElem).append(grayCanvas.jQElem);


    helper.rgb2gray = function(R, G, B) {
        return 0.21 * R + 0.72 * G + 0.07 * B;
    };
    helper.rgbToHsl = function(rgb) {
        var R = rgb[0] / 255,
            G = rgb[1] / 255,
            B = rgb[2] / 255,
            max = mathMax(R, G, B),
            min = mathMin(R, G, B),
            maxMinDif = max - min,
            maxMinSum = max + min,
            h2, s2, l2;

        if (R >= G && R >= B) {
            h2 = (G - B) / maxMinDif;
        } else if (G >= B && G >= R) {
            h2 = 2.0 + ((B - R) / maxMinDif);
        } else {
            h2 = 4.0 + ((R - G) / maxMinDif);
        }

        h2 = h2 < 0 ? (h2 + 6) : h2;

        l2 = maxMinSum / 2;
        s2 = maxMinDif / (l2 > 0.5 ? (2 - maxMinSum) : (maxMinSum));
        return [h2, s2, l2];

    };

    helper.colorComparison = function(hsl, rgb, tolerance) {
        var h = hsl[0],
            s = hsl[1],
            l = hsl[2],
            R = rgb[0] / 255,
            G = rgb[1] / 255,
            B = rgb[2] / 255,
            max = mathMax(R, G, B),
            min = mathMin(R, G, B),
            maxMinDif = max - min,
            maxMinSum = max + min,
            hLim = maxHue * tolerance,
            h2, s2, l2;
        if (maxMinDif === 0) {
            return false;
        }
        if (R >= G && R >= B) {
            h2 = (G - B) / maxMinDif;
        } else if (G >= B && G >= R) {
            h2 = 2.0 + ((B - R) / maxMinDif);
        } else {
            h2 = 4.0 + ((R - G) / maxMinDif);
        }

        h2 = h2 < 0 ? (h2 + 6) : h2;

        // validate the hue
        if (mathAbs(h2 - h) < hLim) { // pass the hue
            l2 = maxMinSum / 2;
            if (mathAbs(l - l2) < tolerance) {
                s2 = maxMinDif / (l2 > 0.5 ? (2 - maxMinSum) : (maxMinSum));
                if (mathAbs(s - s2) < tolerance) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false
            }

        } else {
            return false;
        }
    };


    helper.addDgarMoveEvent = function(elem, onDragFn, dragStartFn, dragEndFn, removeOnMouseOut, endOnDoc, moveOnDoc) {
        var dragStartX, dragStartY,

            removeAll = function() {
                elem.off('mousedown', startDrag)
                    .off(mouseMoveStr, onDrag)
                    .off('mouseup', endDrag)
                    .off('mouseout', endDrag);
                if (endOnDoc) {
                    $(document).on('mouseup', endDrag);
                }
            },
            endDrag = function(event) {
                dragEndFn && dragEndFn(event);
                if (moveOnDoc) {
                    $(document).off(mouseMoveStr, onDrag);
                } else {
                    elem.off(mouseMoveStr, onDrag);
                }
            },
            startDrag = function(event) {
                dragStartFn && dragStartFn(event);
                dragStartX = event.pageX;
                dragStartY = event.pageY;

                if (removeOnMouseOut) {
                    elem.on('mouseout', endDrag);
                }
                if (endOnDoc) {
                    $(document).on('mouseup', endDrag);
                }
                if (moveOnDoc) {
                    $(document).on(mouseMoveStr, onDrag);
                } else {
                    elem.on(mouseMoveStr, onDrag);
                }
            },
            onDrag = function(e) {
                e.dragX = e.pageX - dragStartX;
                e.dragY = e.pageY - dragStartY;
                onDragFn(e);
            };

        elem.on('mousedown', startDrag)
            .on('mouseup', endDrag);
        return removeAll;
    };

    helper.deActivateTool = function() {
        var actTool = helper._config.activTool;
        actTool && tools[actTool].deActivate && tools[actTool].deActivate();
    };

    helper.manipulateGrayCanvas = function() {
        var colorData = colorCanvas.imageData.data,
            grayData = grayCanvas.imageData.data,
            i = 0,
            length = colorData.length;

        for (i = 0; i < length; i += 4) {
            grayData[i + 1] = grayData[i + 2] = grayData[i] = 0.21 * colorData[i] + 0.72 * colorData[i + 1] +
                0.07 * colorData[i + 2];
            grayData[i + 3] = 255;
        }
        grayCanvas.ctx.putImageData(grayCanvas.imageData, 0, 0);
        grayCanvas._helperCtx.putImageData(grayCanvas.imageData, 0, 0);
    };

    helper.syncVirtualCanv = function() {
        var zoomLevel = helper._config.zoomLevel,
            translateX = helper._config.translateX,
            translateY = helper._config.translateY;

        // initially store all work in the virtual canvas
        if (zoomLevel !== 1) {
            visualCanv._helperCtx.scale(1 / zoomLevel, 1 / zoomLevel);
        }

        visualCanv._helperCtx.drawImage(visualCanv.canvasElem, -translateX * zoomLevel, -translateY * zoomLevel);
        visualCanv._helperCtx.setTransform(1, 0, 0, 1, 0, 0);
    };

    helper.syncAllCanvs = function() {
        // set the canvas size
        colorCanvas._helperCanvasElem.width = visualCanv._helperCanvasElem.width =
            grayCanvas._helperCanvasElem.width = colorCanvas.canvasElem.width = grayCanvas.canvasElem.width = canvasW;
        colorCanvas._helperCanvasElem.height = visualCanv._helperCanvasElem.height =
            grayCanvas._helperCanvasElem.height = colorCanvas.canvasElem.height = grayCanvas.canvasElem.height = canvasH;
        // draw the color image
        colorCanvas.ctx.drawImage(visualCanv.canvasElem, 0, 0);
        colorCanvas._helperCtx.drawImage(visualCanv.canvasElem, 0, 0);

        // draw the initial helper image
        visualCanv._helperCtx.drawImage(visualCanv.canvasElem, 0, 0);

        // get the color data
        colorCanvas.imageData = colorCanvas.ctx.getImageData(0, 0, canvasW, canvasH);
        // get the vizCanv data (now blank)
        visualCanv.imageData = visualCanv.ctx.createImageData(canvasW, canvasH);
        // get the gray data (now blank)
        grayCanvas.imageData = grayCanvas.ctx.createImageData(canvasW, canvasH);



        // generate corrosponding gray canvas
        helper.manipulateGrayCanvas();


    };

    helper.loadImage = function(src, type) {
        type = type || 'url';
        if (src) {
            if (type == 'url') {
                var img = new Image();
                img.onload = function() {



                    // set the canvas size
                    canvasW = visualCanv._helperCanvasElem.width = visualCanv.canvasElem.width = img.width;
                    canvasH = visualCanv._helperCanvasElem.height = visualCanv.canvasElem.height = img.height;

                    visualCanv.ctx.drawImage(img, 0, 0);

                    helper.postVisCavDraw();
                };
                img.src = src;
            } else if (type == 'imagedata') {
                // set the canvas size
                canvasW = visualCanv._helperCanvasElem.width = visualCanv.canvasElem.width = src.width;
                canvasH = visualCanv._helperCanvasElem.height = visualCanv.canvasElem.height = src.height;

                visualCanv.ctx.putImageData(src, 0, 0);

                helper.postVisCavDraw();
            }
        }
    };

    helper.postVisCavDraw = function() {
        var t;
        //deactive previous tool
        helper.deActivateTool();


        helper.syncAllCanvs();


        //lode initially the color image
        //helper.drawColorImg();



        //jQLeftToolBox.show();
        //reset all tools
        for (t in tools) {
            tools[t] && tools[t].reset && tools[t].reset();
        }
        // create the first restore point
        //tools.redoUndo.createRestore();

        // set the image status as non-edited
        helper._config.edited = false;


        helper.activeResize();

    };

    helper.activeResize = function() {
        //deactive previous tool
        helper.deActivateTool();
        // load the crop tool  
        tools.resize.activate();
    };

    helper.activateColourPicker = function() {
        //deactive previous tool
        helper.deActivateTool();
        tools.colorPicker.activate();
    };

    helper.activateBrush = function() {
        //deactive previous tool
        helper.deActivateTool();
    };

    helper.preview = function() {
        //deactive previous tool
        helper.deActivateTool();
        tools.preview.activate();

    };

    helper.downLoad = function(id) {
        var link = document.getElementById(id);

        link.href = visualCanv.canvasElem.toDataURL();
        link.download = filename;
    };

    helper.init = function() {
        var t;

        //initialize all tools
        for (t in tools) {
            tools[t] && tools[t].init && tools[t].init();
        }


    };

    helper.syncVisualCanv = function() {
       var zoomLevel = helper._config.zoomLevel,
           translateX = helper._config.translateX,
           translateY = helper._config.translateY;


       (zoomLevel > 1) && visualCanv.ctx.scale(zoomLevel, zoomLevel);
       (translateX !== 0 || translateY !== 0) && visualCanv.ctx.translate(translateX, translateY);
       visualCanv.ctx.drawImage(visualCanv._helperCanvasElem, 0, 0);
       visualCanv.ctx.setTransform(1, 0, 0, 1, 0, 0);
   };


    // ****** Tools ******/

    tools.preview = {
        _config: {},
        reset: function() {

        },
        init: function() {
            if (waterMarkURL) {
                var img = new Image();
                img.onload = function() {
                    var width, height, i, l, index = 0,
                        imgData, minValForWhite = 200,
                        waterCTX, waterMarkImageData;

                    width = wmCanvas.canvasElem.width = img.width;
                    height = wmCanvas.canvasElem.height = img.height;
                    // draw the image
                    wmCanvas.ctx.drawImage(img, 0, 0);

                    wmCanvas.imageData = wmCanvas.ctx.getImageData(0, 0, width, height);

                    // make the white part transparent
                    l = width * height;
                    imgData = wmCanvas.imageData.data;
                    for (index = 0; i < l; index += 4) {
                        if (imgData[index] > minValForWhite && imgData[index + 1] > minValForWhite && imgData[index + 2] > minValForWhite) {
                            //imgData[index] = imgData[index + 1] = imgData[index + 2] = 
                            imgData[index + 3] = 0.1;
                        }

                    }
                    wmCanvas.ctx.putImageData(wmCanvas.imageData, 0, 0)

                }
                img.src = waterMarkURL;
            }
        },
        activate: function() {
            var config = tools.preview._config;
            // set the name of current active tool
            helper._config.activTool = 'preview';

            config.beforeWaterMarkImageData = visualCanv.ctx.getImageData(0, 0, canvasW, canvasH);

            visualCanv.ctx.drawImage(wmCanvas.canvasElem, 0, 0, canvasW, canvasH);
        },
        deActivate: function() {
            var config = tools.preview._config;
            // set the name of current active tool
            helper._config.activTool = '';
            if (config.beforeWaterMarkImageData) {
                visualCanv.ctx.putImageData(config.beforeWaterMarkImageData, 0, 0);
            }
        }
    }


    // add saturation tool
    tools.saturate = {
        _config: {
            pointer_scale: 4
        },
        reset: function() {
            tools.saturate._config.pointer_scale = 4;
        },
        init: function() {
            var jQSaturate = tools.saturate.btn = $('#sat-btn'),
                satSlider = $(document.createElement('div')).addClass(sliderClass)
                .attr('title', 'Increase / decrease the pointer size'),
                config = tools.saturate._config;

            config.satToolBox = $(document.createElement('div')).addClass('subtool-holder')
                .append($(document.createElement(spanStr))
                    .addClass(sbClass).append($(document.createElement(spanStr))
                        .html('Brush size:')).append(satSlider));

            satSlider.slider({
                min: 1,
                max: 5,
                step: 1,
                value: config.pointer_scale / 4,
                change: function(event, ui) {
                    jQCanvas.removeClass('color-brush-' + config.pointer_scale);
                    config.pointer_scale = (ui.value * 4);
                    jQCanvas.addClass('color-brush-' + config.pointer_scale);
                }
            });
            jQSaturate.on(clickStr, function() {
                tools.saturate.activate();
            });
        },
        activate: function() {
            var config = tools.saturate._config;
            // deactive previous tool
            helper.deActivateTool();
            // set the name of current active tool
            helper._config.activTool = 'saturate';
            // apend the toolbox
            jQSubtool.append(tools.saturate._config.satToolBox);

            jQCanvas.addClass('color-brush-' + config.pointer_scale);

            tools.saturate.btn.addClass(selBtnClass);

            // apply the drag event if the image is not in original condition
            if (helper._config.edited) {
                tools.saturate._config.deActivateDrag = helper.addDgarMoveEvent(jQCanvas, tools.saturate._applySat,
                    tools.saturate.dragStart, tools.saturate.dragEnd, false, true);
            }

        },
        dragStart: function() {
            tools.saturate._config.dragged = false;
        },
        dragEnd: function() {
            if (tools.saturate._config.dragged) {
                tools.saturate._config.dragged = false;
                tools.redoUndo.createRestore();
            }
        },
        deActivate: function() {
            var config = tools.saturate._config;
            tools.saturate._config.deActivateDrag && tools.saturate._config.deActivateDrag();
            //remove the toolbox
            tools.saturate._config.satToolBox.detach();

            jQCanvas.removeClass('color-brush-' + config.pointer_scale);
            tools.saturate.btn.removeClass(selBtnClass);

        },
        _applySat: function(e) {
            var offset = visualCanv.jQElem.offset(),
                config = tools.saturate._config,
                pointer_scale = config.pointer_scale,
                x = mathRound(e.pageX - offset.left), // - halfSaturationScale,
                y = mathRound(e.pageY - offset.top), // - halfSaturationScale,
                w = pointer_scale,
                h = pointer_scale;
            config.dragged = true;
            visualCanv.ctx.putImageData(colorCanvas.ctx.getImageData(x, y, w, h), x, y);

        }
    };


    // add desaturation tool
    tools.deSaturate = {
        _config: {
            pointer_scale: 4
        },
        reset: function() {
            tools.deSaturate._config.pointer_scale = 4;
        },
        init: function() {
            var jQDSaturate = tools.deSaturate.btn = $('#desat-btn'),
                deSatSlider = $(document.createElement('div')).addClass(sliderClass).attr('title',
                    'Increase / decrease the pointer size'),
                config = tools.deSaturate._config;

            config.satToolBox = $(document.createElement('div')).addClass('subtool-holder')
                .append($(document.createElement(spanStr))
                    .addClass(sbClass).append($(document.createElement(spanStr))
                        .html('Brush size:')).append(deSatSlider));

            deSatSlider.slider({
                min: 1,
                max: 5,
                step: 1,
                value: config.pointer_scale / 4,
                change: function(event, ui) {
                    jQCanvas.removeClass('gray-brush-' + config.pointer_scale);
                    config.pointer_scale = ui.value * 4;
                    jQCanvas.addClass('gray-brush-' + config.pointer_scale);
                }
            });
            jQDSaturate.on(clickStr, function() {
                tools.deSaturate.activate();
            });
        },
        activate: function() {

            var config = tools.deSaturate._config;
            // deactive previous tool
            helper.deActivateTool();
            // set the name of current active tool
            helper._config.activTool = 'deSaturate';
            // apend the toolbox
            jQSubtool.append(tools.deSaturate._config.satToolBox);
            jQCanvas.addClass('gray-brush-' + config.pointer_scale);
            // apply the drag event
            tools.deSaturate._config.deActivateDrag = helper.addDgarMoveEvent(jQCanvas, tools.deSaturate._applyDeSat,
                tools.deSaturate.dragStart, tools.deSaturate.dragEnd, false, true);

            tools.deSaturate.btn.addClass(selBtnClass);

        },
        dragStart: function() {
            tools.deSaturate._config.dragged = false;
        },
        dragEnd: function() {
            if (tools.deSaturate._config.dragged) {
                tools.deSaturate._config.dragged = false;
                tools.redoUndo.createRestore();
            }
        },
        deActivate: function() {
            var config = tools.deSaturate._config;
            tools.deSaturate._config.deActivateDrag && tools.deSaturate._config.deActivateDrag();
            //remove the toolbox
            tools.deSaturate._config.satToolBox.detach();
            jQCanvas.removeClass('gray-brush-' + config.pointer_scale);
            tools.deSaturate.btn.removeClass(selBtnClass);
        },
        _applyDeSat: function(e) {
            var offset = visualCanv.jQElem.offset(),
                config = tools.deSaturate._config,
                pointer_scale = config.pointer_scale,
                x = mathRound(e.pageX - offset.left), // - halfSaturationScale,
                y = mathRound(e.pageY - offset.top), // - halfSaturationScale,
                w = pointer_scale,
                h = pointer_scale;
            config.dragged = true;
            visualCanv.ctx.putImageData(grayCanvas.ctx.getImageData(x, y, w, h), x, y);
        }
    };


    // add redo undo tool

    tools.redoUndo = {
        _config: {
            restorePoints: [],
            currentRPoint: -1,
            maxStore: 10
        },
        reset: function() {
            tools.redoUndo._config.restorePoints = [];
            tools.redoUndo._config.currentRPoint = -1;
            tools.redoUndo._config.maxStore = 10;
        },
        init: function() {
            var reDoBtn = $('#redo-btn').on(clickStr, tools.redoUndo.reDo),
                unDoBtn = $('#undo-btn').on(clickStr, tools.redoUndo.unDo);

        },
        activate: function() {
            // this should be always active
        },
        deActivate: function() {

        },
        createRestore: function() {
            // first sync the virtual canvas
            helper.syncVirtualCanv();

            var config = tools.redoUndo._config,
                restorePoints = config.restorePoints,
                ImageData = visualCanv._helperCtx.getImageData(0, 0, canvasW, canvasH);

            restorePoints.length = config.currentRPoint + 1;


            restorePoints.push(ImageData);


            // if store exides remove the initial one
            if (restorePoints.length > config.maxStore) {
                restorePoints.shift();
            }
            config.currentRPoint = restorePoints.length - 1;
            tools.redoUndo._configImageEditStatus();
        },
        _configImageEditStatus: function() {
            helper._config.edited = (tools.redoUndo._config.currentRPoint > 0);
        },
        updateLastPoint: function() {
            var config = tools.redoUndo._config,
                restorePoints = config.restorePoints;
            // first sync the virtual canvas
            helper.syncVirtualCanv();
            restorePoints[config.currentRPoint] = visualCanv._helperCtx.getImageData(0, 0, canvasW, canvasH);
        },
        reDo: function() {
            var config = tools.redoUndo._config;

            if (config.currentRPoint < (config.restorePoints.length - 1)) {
                config.currentRPoint += 1;
                tools.redoUndo.updateRPoint(config.currentRPoint);
            }
            tools.redoUndo._configImageEditStatus();
        },
        unDo: function() {
            var config = tools.redoUndo._config;
            if (config.currentRPoint > 0) {
                config.currentRPoint -= 1;
                tools.redoUndo.updateRPoint();
            }
            tools.redoUndo._configImageEditStatus();
        },
        updateRPoint: function() {
            var config = tools.redoUndo._config,
                restorePoints = config.restorePoints;
            visualCanv._helperCtx.putImageData(restorePoints[config.currentRPoint], 0, 0);
            // now sync the virtual canvas
            helper.syncVisualCanv();
        }
    };

    tools.colorPicker = {
        _config: {
            cpCount: 0,
            defaultFuzzyNess: 0.5,
            pixelFiltrationInfo: [],
            activeCp: 1,
            cp1: {
                elem: $('#cp-1'),
                applied: false,
                index: 1, // index starts from 1
                fuzzyNess: 0.5
            },
            cp2: {
                elem: $('#cp-2'),
                applied: false,
                index: 2,
                fuzzyNess: 0.5
            },
        },
        reset: function() {
            var config = tools.colorPicker._config;

            config.pixelFiltrationInfo = [];

            config.pixelFiltrationInfo.length = canvasW * canvasH;
        },
        init: function() {
            var config = tools.colorPicker._config,
                timer;

            $('#cp-1-del').on('click', function() {
                tools.colorPicker.removeCp(1);
            });
            $('#cp-2-del').on('click', function() {
                tools.colorPicker.removeCp(2);
            });

            $('#cp-1-slider').slider({
                min: 0,
                max: 1,
                step: 0.1,
                value: config.defaultFuzzyNess,
                change: function(event, ui) {
                    timer && clearTimeout(timer);
                    timer = setTimeout(function() {
                        var value = ui.value;

                        if (value >= 0 && value <= 1) {
                            config.cp1.fuzzyNess = value;
                            if (config.cp1.applied) {
                                tools.colorPicker.applyFuzzyNess(1);
                                tools.colorPicker.addCPFilters(1);
                                tools.colorPicker.drawFilteredImage();
                            }
                        }
                    }, 100);
                }
            });
            $('#cp-2-slider').slider({
                min: 0,
                max: 1,
                step: 0.1,
                value: config.defaultFuzzyNess,
                change: function(event, ui) {
                    timer && clearTimeout(timer);
                    timer = setTimeout(function() {
                        var value = ui.value;

                        if (value >= 0 && value <= 1) {
                            config.cp2.fuzzyNess = value;

                            if (config.cp2.applied) {
                                tools.colorPicker.applyFuzzyNess(2);
                                tools.colorPicker.addCPFilters(2);
                                tools.colorPicker.drawFilteredImage();
                            }
                        }
                    }, 100);
                }
            });

            config.cp1.elem.css("background-color", "#FFFFFF");
            config.cp2.elem.css("background-color", "#FFFFFF");

        },
        mouseOverListner: function(e) {
            var config = tools.colorPicker._config,
                activeCp = config.activeCp;

            colorData = tools.colorPicker.pickColor(e);
            if (activeCp === 1) {
                config.cp1.elem.css("background-color", tools.colorPicker.getRgba(colorData));
            } else if (activeCp === 2) {
                config.cp2.elem.css("background-color", tools.colorPicker.getRgba(colorData));
            }
        },

        clickListner: function(e) {
            var config = tools.colorPicker._config,
                activeCp = config.activeCp,
                lastCP,
                colorData = tools.colorPicker.pickColor(e);

            if (activeCp === 1) {
                lastCP = config.cp1;
                config.cp1.applied = true;
            } else if (activeCp === 2) {
                lastCP = config.cp2;
                config.cp2.applied = true;
            }

            lastCP.elem.css("background-color", tools.colorPicker.getRgba(colorData));
            lastCP.colorData = colorData;
            tools.colorPicker.applyFuzzyNess(activeCp);
            tools.colorPicker.addCPFilters(activeCp);
            tools.colorPicker.drawFilteredImage();

            tools.colorPicker.checkAndApplyNotApplyedCP();

        },
        checkAndApplyNotApplyedCP: function() {
            var config = tools.colorPicker._config;
            if (!config.cp1.applied) {
                config.activeCp = 1;
            } else if (!config.cp2.applied) {
                config.activeCp = 2;
            } else {
                // set the courser
                jQCanvas.removeClass("color_picker").off("mousemove", tools.colorPicker.mouseOverListner)
                    .off("click", tools.colorPicker.clickListner);
                return;
            }

            if (config.activeCp === 1) {
                config.cp1.elem.css("background-color", "#FFFFFF");
            } else if (config.activeCp === 2) {
                config.cp2.elem.css("background-color", "#FFFFFF");
            }


            // set the courser
            jQCanvas.addClass("color_picker").on("mousemove", tools.colorPicker.mouseOverListner)
                .on("click", tools.colorPicker.clickListner);
        },
        activate: function() {
            var config = tools.colorPicker._config;
            config.cpStoreArr = [];
            config.pixelFiltrationInfo = [];

            helper._config.activTool = 'colorPicker';

            config.pixelFiltrationInfo.length = canvasW * canvasH;

            tools.colorPicker.checkAndApplyNotApplyedCP();
        },
        deActivate: function() {
            helper._config.activTool = '';
            // set the courser
            jQCanvas.removeClass("color_picker").off("mousemove", tools.colorPicker.mouseOverListner)
                .off("click", tools.colorPicker.clickListner);
        },
        removeCp: function(index) {
          var config = tools.colorPicker._config;

            tools.colorPicker.removeCPFilter(index);
            if (index === 1) {
                config.cp1.applied = false;
                tools.colorPicker.addCPFilters(2);
            } else if (index === 2) {
                config.cp2.applied = false;
                tools.colorPicker.addCPFilters(1);
            }

            tools.colorPicker.drawFilteredImage();
            tools.colorPicker.checkAndApplyNotApplyedCP();
        },
        removeCPFilter: function(cpIndex) {
            if (cpIndex) {
                var conf = tools.colorPicker._config,
                pixelFiltrationInfo = conf.pixelFiltrationInfo,
                l = pixelFiltrationInfo.length,
                    i;
                for (i = 0; i < l; i += 1) {
                    if (pixelFiltrationInfo[i] === cpIndex) {
                        delete pixelFiltrationInfo[i];
                    }
                }
            }
        },
        pickColor: function(e) {
            var offset = jQCanvas.offset(),
                imageData;
            imageData = colorCanvas.ctx.getImageData(e.pageX - offset.left, e.pageY - offset.top, 1, 1);
            return imageData.data;
        },
        getRgba: function(colorData) {
            return rgbsStr + colorData[0] + commaStr + colorData[1] + commaStr + colorData[2] + commaStr + (Math.round((colorData[3] / 255) * 100) / 100) + closeBrac;
        },
        applyFuzzyNess: function(index) {
            var cp = index === 1 ? tools.colorPicker._config.cp1 : (index === 2 ? tools.colorPicker._config.cp2 : {});
            cp.hslArr = helper.rgbToHsl(cp.colorData);
        },
        addCPFilters: function(index) {
            var conf = tools.colorPicker._config,
                cp = index === 1 ? conf.cp1 : (index === 2 ? conf.cp2 : {}),
                pixelFiltrationInfo = conf.pixelFiltrationInfo,
                l = pixelFiltrationInfo.length,
                i,
                dataIndex = 0,
                r,
                g,
                b,
                colorData = colorCanvas.imageData.data,
                cpIndex = cp.index,
                fuzzyDis = cp.fuzzyNess,
                cpR = cp.colorData[0],
                cpG = cp.colorData[1],
                cpB = cp.colorData[2],
                hslArr = cp.hslArr;

            for (i = 0; i < l; i += 1, dataIndex += 4) {
                if ((!pixelFiltrationInfo[i]) || pixelFiltrationInfo[i] === cpIndex) {

                    if (helper.colorComparison(hslArr, [colorData[dataIndex], colorData[dataIndex + 1], colorData[dataIndex + 2]], fuzzyDis)) {
                        pixelFiltrationInfo[i] = cpIndex;
                    } else {
                        pixelFiltrationInfo[i] = undefined;
                    }
                }
            }
        },

        drawFilteredImage: function() {
            var conf = tools.colorPicker._config,
                pixelFiltrationInfo = conf.pixelFiltrationInfo,
                l = pixelFiltrationInfo.length,
                filteredImageData = visualCanv.imageData.data,
                imageData = colorCanvas.imageData.data,
                rIndex = 0,
                i, grayVal;
            for (i = 0; i < l; i += 1, rIndex += 4) {
                // set full alpha
                filteredImageData[rIndex + 3] = 255;
                // keep color
                if (pixelFiltrationInfo[i]) {
                    filteredImageData[rIndex] = imageData[rIndex];
                    filteredImageData[rIndex + 1] = imageData[rIndex + 1];
                    filteredImageData[rIndex + 2] = imageData[rIndex + 2];
                } else { // desaturate color
                    grayVal = helper.rgb2gray(imageData[rIndex], imageData[rIndex + 1], imageData[rIndex + 2]);
                    filteredImageData[rIndex] = filteredImageData[rIndex + 1] = filteredImageData[rIndex + 2] = grayVal;
                }
            }
            // draw the filtered image
            visualCanv.ctx.putImageData(visualCanv.imageData, 0, 0);

        }

    };





    tools.resize = {
        _config: {
            classStore: ['', 'overlay_nw', 'overlay_n', 'overlay_ne', 'overlay_e', 'overlay_se', 'overlay_s',
                'overlay_sw', 'overlay_w', ''
            ],
            aspectRatios: [{
                width: 1,
                height: 1,
                label: '1*1'
            }]
        },
        reset: function() {

        },
        init: function() {
            var thisTool = tools.resize,
                config = thisTool._config;


            config.SEElem = $(document.createElement('div')).addClass('overlay_btn overlay_se');

            helper.addDgarMoveEvent(config.SEElem, thisTool.borderDrag, function() {
                    thisTool.borderDragStart(5);
                },
                thisTool.borderDragEnd, undefined, true, true);
        },
        activate: function() {
            var config = tools.resize._config,
                SEElem = config.SEElem;
            // EElem = config.EElem;

            // set the name of current active tool
            helper._config.activTool = 'resize';

            $('div.canvas-holder').append(SEElem);

            config.canvasMove = helper.addDgarMoveEvent(jQCanvas, tools.resize.borderDrag, function() {
                    tools.resize.borderDragStart(9);
                },
                tools.resize.borderDragEnd, undefined, true, true);

            config.x = canvasW / 4;
            config.y = canvasH / 4;
            config.w = canvasW / 2;
            config.h = canvasH / 2;
            // set the overlay
            visualCanv.ctx.fillStyle = 'rgba(10,10,10,0.5)';
            tools.resize._drawOverLay(config.x, config.y, config.w, config.h);

            jQCanvas.addClass('drag_enabled');

            tools.resize.changeAR(0);
        },
        deActivate: function() {
            var config = tools.resize._config,
                imageData = visualCanv.ctx.getImageData(config.x, config.y, config.w, config.h);
            canvasW = visualCanv.canvasElem.width = config.w;
            canvasH = visualCanv.canvasElem.height = config.h;
            visualCanv.ctx.putImageData(imageData, 0, 0);

            helper._config.activTool = '';

            config.SEElem.detach();

            helper.syncAllCanvs();

            jQCanvas.removeClass('drag_enabled');
            config.canvasMove();
        },
        changeAR: function(index) {
            var config = tools.resize._config,
                aspectRatios = config.aspectRatios,
                ar = aspectRatios[index],
                arWidth = ar.width,
                arHeight = ar.height,
                oldH = config.h,
                oldW = config.w,
                newH = mathRound((oldW / arWidth) * arHeight),
                maxH = canvasH - config.y,
                newW,
                maxW;

            if (newH > oldH) {
                if (newH <= maxH) {
                    config.h = newH;
                } else {
                    config.h = maxH;
                    config.w = (maxH / arHeight) * arWidth;
                }
            } else {
                newW = mathRound((oldH / arHeight) * arWidth);
                maxW = canvasW - config.x;
                if (newW <= maxW) {
                    config.w = newW;
                } else {
                    config.w = maxW;
                    config.h = (maxW / arWidth) * arHeight;
                }
            }
            tools.resize._drawOverLay(config.x, config.y, config.w, config.h);
            config.AR = index;
        },
        borderDrag: function(e) {
            // @note min size is 2 * 2
            var config = tools.resize._config,
                aspectRatios = config.aspectRatios,
                arIndex = config.AR,
                ar = aspectRatios[arIndex],
                arWidth = ar.width,
                arHeight = ar.height,
                dragObj = config.drag,
                type = dragObj.type,
                newX = config.x,
                newY = config.y,
                newW = config.w,
                newH = config.h,
                maxW = canvasW - (newX + newW),
                maxH = canvasH - (newY + newH),
                maxHAR = mathRound((maxW / arWidth) * arHeight),
                maxWAR = mathRound((maxH / arHeight) * arWidth),
                dragX = mathRound(e.dragX),
                dragY = mathRound(e.dragY),
                dragXAR = mathRound((dragY / arHeight) * arWidth);



            if (type === 9) {
                dragX = dragX > maxW ? maxW : dragX;
                dragX = dragX < -newX ? -newX : dragX;
                dragY = dragY > maxH ? maxH : dragY;
                dragY = dragY < -newY ? -newY : dragY;
                newX += dragX;
                newY += dragY;
            } else {
                if (dragXAR > dragX) {
                    dragY = mathRound((dragX / arWidth) * arHeight);
                } else {
                    dragX = dragXAR;
                }

                if (maxHAR > maxH) {
                    maxW = maxWAR;
                } else {
                    maxH = maxHAR;
                }
                if (dragX > maxW) {
                    dragX = maxW;
                    dragY = maxH;
                }
                if (dragX <= -newW) {
                    dragX = -newW + 2;
                    dragY = -newH + 2;
                }
                newW += dragX;
                newH += dragY;

            }
            dragObj.x = newX;
            dragObj.y = newY;
            dragObj.w = newW;
            dragObj.h = newH;

            tools.resize._drawOverLay(newX, newY, newW, newH);
        },
        borderDragStart: function(type) {
            var config = tools.resize._config;
            config.drag = {
                x: config.x,
                y: config.y,
                w: config.w,
                h: config.h,
                type: type,
                className: config.classStore[type]
            };

            jQCanvas.addClass(config.drag.className);
        },
        borderDragEnd: function() {
            var config = tools.resize._config,
                dragObj = config.drag;
            if (!dragObj) {
                return;
            }
            config.x = dragObj.x;
            config.y = dragObj.y;
            config.w = dragObj.w;
            config.h = dragObj.h;
            jQCanvas.removeClass(config.drag.className);
        },
        _drawOverLay: function(newX, newY, newW, newH) {
            var config = tools.resize._config,
                // x1 = newX,
                // x2 = newX + newW / 2,
                x3 = newX + newW,
                y1 = newY,
                // y2 = y1 + newH / 2,
                y3 = y1 + newH;

            // draw the image
            visualCanv.ctx.drawImage(visualCanv._helperCanvasElem, 0, 0);
            // draw the _drawOverLay
            visualCanv.ctx.fillRect(0, 0, canvasW, canvasH);

            //draw the visual part
            visualCanv.ctx.putImageData(visualCanv._helperCtx.getImageData(newX, newY, newW, newH), newX, newY);
            config.SEElem.css({
                'left': x3,
                'top': y3
            });

        },


    };




    return helper
})()