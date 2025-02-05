<!DOCTYPE html>
<html>

<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <style type="text/css">
    @media screen {
      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
      }

      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 700;
        src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
      }

      @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 400;
        src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
      }

      @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 700;
        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
      }
    }

    /* CLIENT-SPECIFIC STYLES */
    body,
    table,
    td,
    a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      -ms-interpolation-mode: bicubic;
    }

    /* RESET STYLES */
    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    table {
      border-collapse: collapse !important;
    }

    body {
      height: 100% !important;
      margin: 0 !important;
      padding: 0 !important;
      width: 100% !important;
    }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }

    /* MOBILE STYLES */
    @media screen and (max-width:600px) {
      h1 {
        font-size: 32px !important;
        line-height: 32px !important;
      }
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] {
      margin: 0 !important;
    }

  </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
  <!-- HIDDEN PREHEADER TEXT -->
  <div
    style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    This email is provide you reporting about integration projects status.
  </div>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
      <td bgcolor="#9ca3af" align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
          </tr>
        </table>
      </td>
    </tr>
    {{-- Head --}}
    <tr>
      <td bgcolor="#9ca3af" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td bgcolor="#ffffff" align="center" valign="top"
              style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
              <h1 style="font-size: 48px; font-weight: 400; margin: 2;">{{ config('app.name') }}!</h1>
              <img
                src="https://mpng.subpng.com/20181119/lpf/kisspng-computer-icons-scalable-vector-graphics-portable-n-gmail-undo-send-google-mail-5bf311d368f0f6.3464410815426564674298.jpg"
                width="125" height="120" style="display: block; border: 0px;" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    {{-- j count --}}
    <tr>
      <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td bgcolor="#ffffff" align="left"
              style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
              <p style="margin: 0;">{{ config('custom-log.emails.message') }}.</p>
            </td>
          </tr>
          {{-- exceptions count --}}
          <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                  <td bgcolor="#9ca3af" align="center"
                    style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: white; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                    <h1 style="margin: 0;">Total
                      Exceptions:{{ $totalErrors }}</h1>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          {{-- jobs failed count --}}
          <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                  <td bgcolor="#9ca3af" align="center"
                    style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: white; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                    <h1 style="margin: 0;">Total
                      Jobs failed:{{ $jobsFailed }}</h1>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          {{-- view exceptions button --}}
          {{-- 50 latest exceptions --}}
          <tr>
            <td align="center" style="padding: 30px 10px 0px 10px;margin-top:20px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                  <td bgcolor="#9ca3af" align="center">
                    <h1 style="margin: 0;">
                      Here is the list of recent exceptions</h1>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td align="left">
              <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                @php
                  $i = 1;
                @endphp
                @foreach ($exceptions as $exception)
                  <tr>
                    <td align="left">
                      <p style="margin:0 0 10px 0;line-height:1.8;font-size:16px;font-family: 'Roboto', sans-serif;font-weight: 400;">
                        <a href="{{ url('exceptions/' . $exception->id . '/show') }}" title="please click on link to view the details" style="text-decoration: none;">
                          {{ $i++ }} - {{ $exception->message }}
                        </a>
                      </p>
                    </td>
                  </tr>
                @endforeach
              </table>
            </td>
          </tr>



          {{-- view exceptions button --}}
          <tr>
            <td bgcolor="#ffffff" align="left">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" style="border-radius: 3px;" bgcolor="#9ca3af">
                          <a href="{{ url('exceptions?pass=' . \Crypt::encryptString('info@hellokongo.com')) }}" target="_blank"
                            style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #9ca3af; display: inline-block;">
                            See error details</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
