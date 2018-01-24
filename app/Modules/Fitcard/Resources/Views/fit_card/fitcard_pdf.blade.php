<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <link href="{{ public_path('admin/assets/css/fit_card.css') }}" rel="stylesheet">

</head>

<body>

<div class="uk-grid" style="text-align: center;" data-uk-grid-margin="">                         
    <div class="uk-width-small-5-5 uk-text-center">
        <img style="margin-bottom: -20px;" class="logo_regular" src="{{ public_path('/uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
        <p style="line-height: 5px; margin-top: 35px;" class="uk-text-large">{{ $OrganizationProfile->company_name }}</p>
        <p style="line-height: 5px;" class="uk-text-small">Medical Report For Foreign Worker</p>
    </div>
</div>

<table id="header">
    <tr>
        <td>MC Ref. No : 8714</td>
        <td>REG. DATE : 20/12/2017 , VALID UNTIL : 24/03/2018</td>
    </tr>

</table>
<hr />

<div>
    <div id="div-main-part">
        <table id="main-part">
            <tr>
                <td>
                    1. FULL NAME
                </td>
                <td>
                    MIAH ROBEL
                </td>
            </tr>
            <tr>
                <td>
                    2. REGISTRATION NO
                </td>
                <td>
                    BGD/249/BP0/20170607191229
                </td>
            </tr>
            <tr>
                <td>
                    3. FATHER'S NAME
                </td>
                <td>
                    ABDUR RAZZAK
                </td>
            </tr>
            <tr>
                <td>
                    4. MALE/FEMALE
                </td>
                <td>
                    MALE
                </td>
            </tr>
            <tr>
                <td>
                    6. PASSPORT NO
                </td>
                <td>
                    BP0222300
                </td>
            </tr>
            <tr>
                <td>
                    7. TYPE OF WORKER
                </td>
                <td>
                    FOREIGN WORKER
                </td>
            </tr>
            <tr>
                <td>
                    8. RESIDENCE IN COUNTRY OF ORIGIN
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    ADDRESS:
                </td>
                <td>
                    BANAIL, VABKHONDO, MIRZAPUR, TANGAIL
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    COUNTRY:
                </td>
                <td>
                    BANGLADESH
                </td>
            </tr>
            <tr>
                <td>
                    9. NAME OF RECRUITING AGENCY
                </td>
                <td>
                    AL-ISLAM OVERSEAS
                </td>
            </tr>
            <tr>
                <td>
                    10. ADDRESS OF RECRUITING AGENCY
                </td>
                <td>
                    ORCHARD FAROQUE TOWER, 72 NAYAPALITAN, VIP ROAD, SUI TE NO.7C DHAKA
                </td>
            </tr>
        </table>
    </div>
    <div id="side-bar">
        PHOTO<br>
        <img src="{{ public_path('/img/user.png') }}">
    </div>
</div>
<hr>
<div>
    <div id="div-body-part">
        I HAVE EXAMINED THE FOLLOWING DETAILS AND FOUND THAT:<br>
        1. HE IS FREE FROM THE FOLLOWING DISEASES/CONDITIONS:<br>

        <table id="main-part">
            <tr>
                <td>
                    
                </td>
                <td>
                    YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NO
                </td>
            </tr>
            <tr>
                <td>
                    HIV/AIDS
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    TB
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    MALARIA
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    LEPROSY
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    FREE FROM OTHER CHRONIC DISEASES
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    PHYSICAL EXAMINATION
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    MAJOR PSYCHIATRIC DISORDERS
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
        </table>
        2. HIS URINE IS FOUND NOT TO CONTAIN OPIATE/CANNABIS<br>
        3. HE IS FIT TO WORK<br>
        4. I THEREFORE RECOMMEND THAT HE BE CONSIDERED FOR EMPLOYMENT
    </div>
    <div id="div-body-part-right">
        <br><br>
        <table id="main-part">
            <tr>
                <td>
                    
                </td>
                <td>
                    YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NO
                </td>
            </tr>
            <tr>
                <td>
                    SYPHILIS
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    HEPATITIS B
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    UNACCEPTABLE CLINICAL FINDINGS INCHEST X-RAY
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    TUMOR/CANCER
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
            <tr>
                <td>
                    EPILEPSY
                </td>
                <td>
                    <input type="checkbox" checked="checked">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" >
                </td>
            </tr>
        </table>
        <br>
        (SCHIZOPHRENIA, BIPOLAR AFFECTIVE DISORDER MAJOR DEPRESSION DELUSIONAL AND OTHER PSYCHOTIC DISORDERS)
    </div>
</div>
<div class="additional-information">
    <p>ADDITIONAL INFORMATION</p>
    <div class="information">
        FIT FOR JOB
    </div>
</div>
<br>
<div>
    <div id="signature-left">
        DOCTOR SIGNATURE AND NAME
        <div id="signature">
            
        </div>
        <br>
        <div id="signature-small">
            DR MD ZAKIR HOSSAIN KHAN
        </div>
        <br>
        DOCTOR QUALIFICATIONS
        <div id="signature-small">
            MBBS
        </div>
    </div>
    <div style="width: 40%; float: left;">
        
    </div>
    <div id="signature-right">
        DOCTOR ADDRESS
        <div id="signature-small">
            DHAKA
        </div>
        <br><br><br>
        DOCTOR SEAL
        <div id="signature">
            
        </div>
    </div>
</div>
<br><br><br>
<hr>
</body>

</html>