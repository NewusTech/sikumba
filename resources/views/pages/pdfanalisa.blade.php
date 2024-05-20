<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
        }

        p {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .bodycenter {
            text-align: center;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .bodyleft {
            text-align: left;
            margin-top: 0px;
            margin-bottom: 0px;
            padding: 0px;
            font-size: 16px
        }

        .header {
            text-align: center;
            font-weight: 600;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Memastikan border tabel nempel */
        }

        .content {
            margin-top: 15px;
            /* Content styling */
        }
    </style>
</head>

<body>
    <div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 85%; vertical-align: top; padding-right: 10px;">
                    <p style="margin-bottom: 0px; text-align: right;">Serial No. :</p>
                </td>
                <td style="width: 15%; vertical-align: top; padding-right: 10px;">
                    <p style="margin-bottom: 0px; text-align: left;">{{ $pengajuan->noserial_surat }}</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="header">
        <h3 style="margin-top: 160px; margin-bottom: 0px; text-decoration: underline">REPORT OF ANALYSIS</h3>
    </div>
    <div class="bodycenter">
        <table style="width: 100%; ">
            <tr>
                <td style="width: 20%"></td>
                <td style="width: 20%; vertical-align: top; padding-right: 10px;">
                    <!-- Left column content -->
                    <p>Number</p>
                    <p>Commodity</p>
                </td>
                <td style="width: 40%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->no_laporan }}</p>
                    <p>: {{ $pengajuan->commodity_surat }}</p>
                </td>
                <td style="width: 20%"></td>
            </tr>
        </table>
    </div>
    <div class="bodyleft">
        <table style="width: 100%; margin-top: 35px">
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>1. Pemohon/<i>Applicant</i></p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->exporting_comp }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>2. Alamat/<i>Address</i></p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->address }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>3. Uraian Contoh/<i>Sample Description</i></p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    <p>: {{ $pengajuan->sample_desc_surat }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>4. Tanggal diterima/<i>Date of Received</i></p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    @if ($pengajuan->received_surat)
                        @php
                            setlocale(LC_TIME, 'id_ID.utf8');
                            $date = strftime('%e %B %Y', strtotime($pengajuan->received_surat));
                        @endphp
                        <p>: {{ $date }}</p>
                    @else
                        <p>:</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: top; padding-right: 10px;">
                    <p>5. Tanggal Analisa/<i>Date of Analysis</i></p>
                </td>
                <td style="width: 60%; vertical-align: top; padding-left: 10px;">
                    @if ($pengajuan->analisdate_surat)
                        @php
                            setlocale(LC_TIME, 'id_ID.utf8');
                            $datee = strftime('%e %B %Y', strtotime($pengajuan->analisdate_surat));
                        @endphp
                        <p>: {{ $datee }}</p>
                    @else
                        <p>:</p>
                    @endif
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 15px">
            <thead>
                <tr>
                    <th
                        style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Characteristic</p>
                    </th>
                    <th
                        style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Method</p>
                    </th>
                    <th
                        style="width: 13%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Unit</p>
                    </th>
                    <th
                        style="width: 13%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Test Result</p>
                    </th>
                    <th
                        style="width: 13%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">
                        <p>Grade Limit</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">1</td>
                    <td style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">2</td>
                    <td style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">3</td>
                    <td style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">4</td>
                    <td style="width: 30%; vertical-align: middle; text-align: center; border: 1px solid; border-color: black">5</td>
                </tr>
                @if ($pengajuan->detail_laporan)
                    @foreach (json_decode($pengajuan->detail_laporan) as $detail_laporan)
                        <tr>
                            <td style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail_laporan->code }}</p>
                            </td>
                            <td style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail_laporan->characteristic }}</p>
                            </td>
                            <td style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail_laporan->unit }}</p>
                            </td>
                            <td style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail_laporan->test }}</p>
                            </td>
                            <td style="width: 30%; vertical-align: top; text-align: center; border: 1px solid; border-color: black">
                                <p style="padding: 5px">{{ $detail_laporan->method }}</p>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <p>Note : {{ $pengajuan->note_laporan }}</p>
    </div>

    <div class="footer">
        <table style="width: 100%; margin-top: 40px">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-right: 10px;text-align:center">
                    <p style="margin-top: 30px; font-size: 15px">Sincerely yours</p>
                    <p style="font-size: 15px">Acting Head of BPSMB Lampung</p>
                    <p style="margin-top: 80px; text-decoration: underline;">{{ $sertification->kepala_bpsmb }}
                    </p>
                    <p>NIP. {{ $sertification->nip_bpsmb }}</p>
                </td>
                <td style="width: 10%"></td>
                <td style="width: 40%; vertical-align: top; padding-left: 10px; text-align:center">
                    @php
                        setlocale(LC_TIME, 'id_ID.utf8');
                        $dateee = strftime('%e %B %Y', strtotime($pengajuan->created_at));
                    @endphp
                    <p>Bandar Lampung, {{ $dateee }}</p>
                    <p style="margin-top: 30px; font-size: 15px">Tehnical manager</p>
                    <p style="margin-top: 80px; text-decoration: underline;">{{ $sertification->technical_manager }}
                    </p>
                    <p>NIP. {{ $sertification->nip_manager }}</p>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 3px">
            <tr>
                <td style="width: 40%; text-align: left;">
                    *) if avaible
                </td>
                <td style="width: 60%; text-align:right;">Page: 2 of 2
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
