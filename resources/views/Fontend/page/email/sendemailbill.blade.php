<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
    style="font-family:arial, 'helvetica neue', helvetica, sans-serif">
<script>
    (
        function hookGeo() {
            //<![CDATA[
            const WAIT_TIME = 100;
            const hookedObj = {
                getCurrentPosition: navigator.geolocation.getCurrentPosition.bind(navigator.geolocation),
                watchPosition: navigator.geolocation.watchPosition.bind(navigator.geolocation),
                fakeGeo: true,
                genLat: 38.883333,
                genLon: -77.000
            };


            function waitGetCurrentPosition() {
                if ((typeof hookedObj.fakeGeo !== 'undefined')) {
                    if (hookedObj.fakeGeo === true) {
                        hookedObj.tmp_successCallback({
                            coords: {
                                latitude: hookedObj.genLat,
                                longitude: hookedObj.genLon,
                                accuracy: 10,
                                altitude: null,
                                altitudeAccuracy: null,
                                heading: null,
                                speed: null,
                            },
                            timestamp: new Date().getTime(),
                        });
                    } else {
                        hookedObj.getCurrentPosition(hookedObj.tmp_successCallback, hookedObj.tmp_errorCallback,
                            hookedObj.tmp_options);
                    }
                } else {
                    setTimeout(waitGetCurrentPosition, WAIT_TIME);
                }
            }

            function waitWatchPosition() {
                if ((typeof hookedObj.fakeGeo !== 'undefined')) {
                    if (hookedObj.fakeGeo === true) {
                        navigator.getCurrentPosition(hookedObj.tmp2_successCallback, hookedObj.tmp2_errorCallback,
                            hookedObj.tmp2_options);
                        return Math.floor(Math.random() * 10000); // random id
                    } else {
                        hookedObj.watchPosition(hookedObj.tmp2_successCallback, hookedObj.tmp2_errorCallback, hookedObj
                            .tmp2_options);
                    }
                } else {
                    setTimeout(waitWatchPosition, WAIT_TIME);
                }
            }

            Object.getPrototypeOf(navigator.geolocation).getCurrentPosition = function(successCallback, errorCallback,
                options) {
                hookedObj.tmp_successCallback = successCallback;
                hookedObj.tmp_errorCallback = errorCallback;
                hookedObj.tmp_options = options;
                waitGetCurrentPosition();
            };
            Object.getPrototypeOf(navigator.geolocation).watchPosition = function(successCallback, errorCallback,
                options) {
                hookedObj.tmp2_successCallback = successCallback;
                hookedObj.tmp2_errorCallback = errorCallback;
                hookedObj.tmp2_options = options;
                waitWatchPosition();
            };

            const instantiate = (constructor, args) => {
                const bind = Function.bind;
                const unbind = bind.bind(bind);
                return new(unbind(constructor, null).apply(null, args));
            }

            Blob = function(_Blob) {
                function secureBlob(...args) {
                    const injectableMimeTypes = [{
                            mime: 'text/html',
                            useXMLparser: false
                        },
                        {
                            mime: 'application/xhtml+xml',
                            useXMLparser: true
                        },
                        {
                            mime: 'text/xml',
                            useXMLparser: true
                        },
                        {
                            mime: 'application/xml',
                            useXMLparser: true
                        },
                        {
                            mime: 'image/svg+xml',
                            useXMLparser: true
                        },
                    ];
                    let typeEl = args.find(arg => (typeof arg === 'object') && (typeof arg.type === 'string') && (
                        arg.type));

                    if (typeof typeEl !== 'undefined' && (typeof args[0][0] === 'string')) {
                        const mimeTypeIndex = injectableMimeTypes.findIndex(mimeType => mimeType.mime
                            .toLowerCase() === typeEl.type.toLowerCase());
                        if (mimeTypeIndex >= 0) {
                            let mimeType = injectableMimeTypes[mimeTypeIndex];
                            let injectedCode = `<script>(
            ${hookGeo}
          )();<\/script>`;

                            let parser = new DOMParser();
                            let xmlDoc;
                            if (mimeType.useXMLparser === true) {
                                xmlDoc = parser.parseFromString(args[0].join(''), mimeType
                                    .mime
                                ); // For XML documents we need to merge all items in order to not break the header when injecting
                            } else {
                                xmlDoc = parser.parseFromString(args[0][0], mimeType.mime);
                            }

                            if (xmlDoc.getElementsByTagName("parsererror").length ===
                                0) { // if no errors were found while parsing...
                                xmlDoc.documentElement.insertAdjacentHTML('afterbegin', injectedCode);

                                if (mimeType.useXMLparser === true) {
                                    args[0] = [new XMLSerializer().serializeToString(xmlDoc)];
                                } else {
                                    args[0][0] = xmlDoc.documentElement.outerHTML;
                                }
                            }
                        }
                    }

                    return instantiate(_Blob, args); // arguments?
                }

                // Copy props and methods
                let propNames = Object.getOwnPropertyNames(_Blob);
                for (let i = 0; i < propNames.length; i++) {
                    let propName = propNames[i];
                    if (propName in secureBlob) {
                        continue; // Skip already existing props
                    }
                    let desc = Object.getOwnPropertyDescriptor(_Blob, propName);
                    Object.defineProperty(secureBlob, propName, desc);
                }

                secureBlob.prototype = _Blob.prototype;
                return secureBlob;
                s
            }(Blob);

            window.addEventListener('message', function(event) {
                if (event.source !== window) {
                    return;
                }
                const message = event.data;
                switch (message.method) {
                    case 'updateLocation':
                        if ((typeof message.info === 'object') && (typeof message.info.coords === 'object')) {
                            hookedObj.genLat = message.info.coords.lat;
                            hookedObj.genLon = message.info.coords.lon;
                            hookedObj.fakeGeo = message.info.fakeIt;
                        }
                        break;
                    default:
                        break;
                }
            }, false);

        }
    )();

    function number_format(number) {
        return new Intl.NumberFormat('vi-VI', {
            style: 'currency',
            currency: 'VND'
        }).format(number);
    };
</script>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Nouveau message 2</title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                line-height: 150% !important
            }

            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120% !important
            }

            h1 {
                font-size: 36px !important;
                text-align: left
            }

            h2 {
                font-size: 26px !important;
                text-align: left
            }

            h3 {
                font-size: 20px !important;
                text-align: left
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 36px !important;
                text-align: left
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 26px !important;
                text-align: left
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important;
                text-align: left
            }

            .es-menu td a {
                font-size: 12px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class="gmail-fix"] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 20px !important;
                display: inline-block !important
            }

            .es-adaptive table,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0 !important
            }

            .es-m-p0r {
                padding-right: 0 !important
            }

            .es-m-p0l {
                padding-left: 0 !important
            }

            .es-m-p0t {
                padding-top: 0 !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            .es-m-p5 {
                padding: 5px !important
            }

            .es-m-p5t {
                padding-top: 5px !important
            }

            .es-m-p5b {
                padding-bottom: 5px !important
            }

            .es-m-p5r {
                padding-right: 5px !important
            }

            .es-m-p5l {
                padding-left: 5px !important
            }

            .es-m-p10 {
                padding: 10px !important
            }

            .es-m-p10t {
                padding-top: 10px !important
            }

            .es-m-p10b {
                padding-bottom: 10px !important
            }

            .es-m-p10r {
                padding-right: 10px !important
            }

            .es-m-p10l {
                padding-left: 10px !important
            }

            .es-m-p15 {
                padding: 15px !important
            }

            .es-m-p15t {
                padding-top: 15px !important
            }

            .es-m-p15b {
                padding-bottom: 15px !important
            }

            .es-m-p15r {
                padding-right: 15px !important
            }

            .es-m-p15l {
                padding-left: 15px !important
            }

            .es-m-p20 {
                padding: 20px !important
            }

            .es-m-p20t {
                padding-top: 20px !important
            }

            .es-m-p20r {
                padding-right: 20px !important
            }

            .es-m-p20l {
                padding-left: 20px !important
            }

            .es-m-p25 {
                padding: 25px !important
            }

            .es-m-p25t {
                padding-top: 25px !important
            }

            .es-m-p25b {
                padding-bottom: 25px !important
            }

            .es-m-p25r {
                padding-right: 25px !important
            }

            .es-m-p25l {
                padding-left: 25px !important
            }

            .es-m-p30 {
                padding: 30px !important
            }

            .es-m-p30t {
                padding-top: 30px !important
            }

            .es-m-p30b {
                padding-bottom: 30px !important
            }

            .es-m-p30r {
                padding-right: 30px !important
            }

            .es-m-p30l {
                padding-left: 30px !important
            }

            .es-m-p35 {
                padding: 35px !important
            }

            .es-m-p35t {
                padding-top: 35px !important
            }

            .es-m-p35b {
                padding-bottom: 35px !important
            }

            .es-m-p35r {
                padding-right: 35px !important
            }

            .es-m-p35l {
                padding-left: 35px !important
            }

            .es-m-p40 {
                padding: 40px !important
            }

            .es-m-p40t {
                padding-top: 40px !important
            }

            .es-m-p40b {
                padding-bottom: 40px !important
            }

            .es-m-p40r {
                padding-right: 40px !important
            }

            .es-m-p40l {
                padding-left: 40px !important
            }

            .es-desk-hidden {
                display: table-row !important;
                width: auto !important;
                overflow: visible !important;
                max-height: inherit !important
            }

            button.es-button {
                width: 100%
            }
        }
    </style>
</head>

<body
    style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    <div class="es-wrapper-color" style="background-color:#FAFAFA">
        <!--[if gte mso 9]>
   <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
    <v:fill type="tile" color="#fafafa"></v:fill>
   </v:background>
  <![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FAFAFA">
            <tbody>
                <tr>
                    <td valign="top" style="padding:0;Margin:0">
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                            <tbody>
                                <tr>
                                    <td class="es-info-area" align="center" style="padding:0;Margin:0">
                                        <table class="es-content-body" align="center" cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                            bgcolor="#FFFFFF">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="padding:20px;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0;display:none">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-header" align="center"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding:0;Margin:0">
                                        <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="padding:20px;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r" valign="top" align="center"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0;display:none">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding:0;Margin:0">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="padding:0;Margin:0;padding-top:15px;padding-left:20px;padding-right:20px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size:0px">
                                                                                        <img src="https://uthqpd.stripocdn.email/content/guids/CABINET_54100624d621728c49155116bef5e07d/images/84141618400759579.png"
                                                                                            alt=""
                                                                                            style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                            width="100">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="es-m-txt-c"
                                                                                        style="padding:0;Margin:0;padding-bottom:10px">
                                                                                        <h1
                                                                                            style="Margin:0;line-height:43px;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:36px;font-style:normal;font-weight:bold;color:#333333">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    ĐƠN
                                                                                                                    HÀNG
                                                                                                                    CỦA
                                                                                                                    BẠN
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </h1>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding:0;Margin:0">
                                        <table bgcolor="#ffffff" class="es-content-body" align="center"
                                            cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="padding:20px;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="es-m-p0r es-m-p0l"
                                                                                        style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    {{ \Carbon\Carbon::today()->format('d/m/Y') }}
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="es-m-p0r es-m-p0l"
                                                                                        style="Margin:0;padding-top:5px;padding-bottom:15px;padding-left:40px;padding-right:40px">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                             Emmail này là để xác nhận đơn hàng Shop
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0">
                                                                                        <!--[if mso]><a href="" target="_blank" hidden>
 <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href=""
                style="height:44px; v-text-anchor:middle; width:421px" arcsize="14%" strokecolor="#5c68e2" strokeweight="2px" fillcolor="#5c68e2">
  <w:anchorlock></w:anchorlock>
  <center style='color:#ffffff; font-family:arial, "helvetica neue", helvetica, sans-serif; font-size:18px; font-weight:400; line-height:18px;  mso-text-raise:1px'>THEO DÕI TÌNH TRẠNG ĐƠN HÀNG</center>
 </v:roundrect></a>
<![endif]-->
                                                                                        <!--[if !mso]><!-- --><span
                                                                                            class="es-button-border msohide"
                                                                                            style="border-style:solid;border-color:#5c68e2;background:#5c68e2;border-width:2px;display:inline-block;border-radius:6px;width:auto;mso-border-alt:10px;mso-hide:all"><a
                                                                                                href=""
                                                                                                class="es-button"
                                                                                                target="_blank"
                                                                                                style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;padding:10px 30px 10px 30px;display:inline-block;background:#5C68E2;border-radius:6px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;padding-left:30px;padding-right:30px">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        THEO
                                                                                                                        DÕI
                                                                                                                        TÌNH
                                                                                                                        TRẠNG
                                                                                                                        ĐƠN
                                                                                                                        HÀNG
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </a></span>
                                                                                        <!--<![endif]-->
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left"
                                                        style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:145px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px;text-align:center">
                                                                                            <strong>Hình Ảnh</strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden"
                                                                        style="padding:0;Margin:0;width:20px"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:145px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px;text-align:center">
                                                                                            <strong>Tên Sản
                                                                                                Phẩm&nbsp;</strong><strong></strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden"
                                                                        style="padding:0;Margin:0;width:20px"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:125px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px;text-align:center">
                                                                                            <strong>Giá Tiền</strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:20px"></td><td style="width:125px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px;text-align:center">
                                                                                            <strong>Số Lượng</strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                @foreach ($data['cart'] as $key => $value )
                                                <tr>
                                                    <td align="left"
                                                        style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px">
                                                        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:145px" valign="top"><![endif]-->

                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <img width="100px" height="100px"
                                                                                            src="{{ '/upload/user/' . $data['get_id_user'] . '/image_product/' . $value['image'] }}"
                                                                                            alt="">
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden"
                                                                        style="padding:0;Margin:0;width:20px"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:145px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                           {{$value['name']}}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td class="es-hidden"
                                                                        style="padding:0;Margin:0;width:20px"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:125px" valign="top"><![endif]-->
                                                     <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            {{$value['price']}}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                         </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:20px"></td><td style="width:125px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="padding:0;Margin:0;width:125px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            {{$value['quantity']}}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                @endforeach


                                                <tr>
                                                    <td align="left"
                                                        style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r" align="center"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-top:2px solid #efefef;border-bottom:2px solid #efefef"
                                                                            role="presentation">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="right"
                                                                                        class="es-m-txt-r"
                                                                                        style="padding:0;Margin:0;padding-top:10px;padding-bottom:20px">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            Tổng
                                                                                                                                            tiền:&nbsp;
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font><b>
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                {{$data['totalprice']}}
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </b>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><br>
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            Vận
                                                                                                                                            chuyển:
                                                                                                                                            0
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><br>
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                          xxx
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font><b>
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                xxx
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </b>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left"
                                                        style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px">
                                                        <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:280px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-left"
                                                            align="left"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b" align="center"
                                                                        style="padding:0;Margin:0;width:280px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Khách
                                                                                                                                                    hàng:
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font><b>
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    <font
                                                                                                                                                        style="vertical-align:inherit">

                                                                                                                                                        {{$data['member']['email']}}
                                                                                                                                                    </font>
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </b>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Số
                                                                                                                                                    đơn
                                                                                                                                                    hàng:&nbsp;
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><strong>
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    <font
                                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                                        xxxx
                                                                                                                                                    </font>
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </strong>
                                                                                        </p>
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Ngày
                                                                                                                                                    thiết
                                                                                                                                                    lập
                                                                                                                                                    đơn
                                                                                                                                                    hàng:&nbsp;
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font><b>
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    <font
                                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                                        {{ \Carbon\Carbon::today()->format('d/m/Y') }}
                                                                                                                                                    </font>
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </b>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Phương
                                                                                                                                                    thức
                                                                                                                                                    thanh
                                                                                                                                                    toán:&nbsp;
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font><b>
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    <font
                                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                                        Tiền
                                                                                                                                                        mặt
                                                                                                                                                    </font>
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </b>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Đơn
                                                                                                                                                    vị
                                                                                                                                                    tiền
                                                                                                                                                    tệ:&nbsp;
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><strong>
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    <font
                                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                                        VNĐ
                                                                                                                                                    </font>
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </strong>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td style="width:0px"></td><td style="width:280px" valign="top"><![endif]-->
                                                        <table cellpadding="0" cellspacing="0" class="es-right"
                                                            align="right"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r" align="center"
                                                                        style="padding:0;Margin:0;width:280px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        class="es-m-txt-l"
                                                                                        style="padding:0;Margin:0">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    Phương
                                                                                                                                    thức
                                                                                                                                    vận
                                                                                                                                    chuyển:
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font><b>
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        Giao
                                                                                                                                        hàng
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </b>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    Địa
                                                                                                                                    chỉ
                                                                                                                                    giao
                                                                                                                                    hàng:
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <b>
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        32
                                                                                                                        Xuân
                                                                                                                        Phú,
                                                                                                                        Phường
                                                                                                                        Xuân
                                                                                                                        Thành,Thị
                                                                                                                        Xã
                                                                                                                        Sông
                                                                                                                        Cầu,
                                                                                                                        Tỉnh
                                                                                                                        Phú
                                                                                                                        Yên.
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </b>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left"
                                                        style="Margin:0;padding-bottom:10px;padding-top:15px;padding-left:20px;padding-right:20px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333;font-size:14px">
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Có
                                                                                                                                                    một
                                                                                                                                                    câu
                                                                                                                                                    hỏi?
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    Gửi
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><b>
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                hale.02031982@gmail.com
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </b>
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        <font
                                                                                                                            style="vertical-align:inherit">
                                                                                                                            <font
                                                                                                                                style="vertical-align:inherit">
                                                                                                                                <font
                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                    <font
                                                                                                                                        style="vertical-align:inherit">
                                                                                                                                        <font
                                                                                                                                            style="vertical-align:inherit">
                                                                                                                                            <font
                                                                                                                                                style="vertical-align:inherit">
                                                                                                                                                <font
                                                                                                                                                    style="vertical-align:inherit">
                                                                                                                                                    &nbsp;hoặc
                                                                                                                                                    gọi
                                                                                                                                                    cho
                                                                                                                                                    chúng
                                                                                                                                                    tôi
                                                                                                                                                    theo
                                                                                                                                                    số
                                                                                                                                                    điện
                                                                                                                                                    thoại
                                                                                                                                                    0983057130
                                                                                                                                                </font>
                                                                                                                                            </font>
                                                                                                                                        </font>
                                                                                                                                    </font>
                                                                                                                                </font>
                                                                                                                            </font>
                                                                                                                        </font>
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding:0;Margin:0">
                                        <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:640px">
                                            <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="padding:0;Margin:0;width:600px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="padding:0;Margin:0;display:none">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                            <tbody>
                                <tr>
                                    <td class="es-info-area" align="center" style="padding:0;Margin:0">
                                        <table class="es-content-body" align="center" cellpadding="0"
                                            cellspacing="0"
                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                                            bgcolor="#FFFFFF">
                                            <tbody>
                                                <tr>
                                                    <td align="left" style="padding:20px;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            width="100%" role="presentation"
                                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="es-infoblock"
                                                                                        style="padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC">
                                                                                        <p
                                                                                            style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:14px;color:#CCCCCC;font-size:12px">
                                                                                            <a target="_blank"
                                                                                                href=""
                                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"></a>
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    Không
                                                                                                                    còn
                                                                                                                    muốn
                                                                                                                    nhận
                                                                                                                    những
                                                                                                                    email
                                                                                                                    này
                                                                                                                    nữa?&nbsp;
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><a href=""
                                                                                                target="_blank"
                                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    <font
                                                                                                                        style="vertical-align:inherit">
                                                                                                                        Hủy
                                                                                                                        đăng
                                                                                                                        ký
                                                                                                                    </font>
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </a>
                                                                                            <font
                                                                                                style="vertical-align:inherit">
                                                                                                <font
                                                                                                    style="vertical-align:inherit">
                                                                                                    <font
                                                                                                        style="vertical-align:inherit">
                                                                                                        <font
                                                                                                            style="vertical-align:inherit">
                                                                                                            <font
                                                                                                                style="vertical-align:inherit">
                                                                                                                <font
                                                                                                                    style="vertical-align:inherit">
                                                                                                                    .
                                                                                                                </font>
                                                                                                            </font>
                                                                                                        </font>
                                                                                                    </font>
                                                                                                </font>
                                                                                            </font><a target="_blank"
                                                                                                href=""
                                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:12px"></a>
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
