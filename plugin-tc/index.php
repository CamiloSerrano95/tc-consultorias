<?php
    require_once 'utils/Conexion.php';
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $connection = new Conexion();
    $dataBase = $connection->get_conexion();

    try {
        $sql = "SELECT licitacion.nombre, contractual_processes.* FROM licitacion, contractual_processes 
        WHERE contractual_processes.contract_id = licitacion.id";
        $query = $dataBase->prepare($sql);
        $query->execute();
        $contractual_processes = $query->fetchAll();
    } catch (Exception $e) {
        $response = ['status' => 0, 'error' => $e];
    }

    $spreadsheet = IOFactory::load('resource/procesos-contractuales.xlsx');
    $sheetActive = $spreadsheet->getActiveSheet();

    function compareDate($date, $sheetActive, $celdas) {
        $today = strtotime(date("Y-m-d"));
        $date = strtotime($date);
        
        if ($today > $date) {
            $info = 'vencido';
            $color = 'FF0000';
        } else if ($today < $date) {
            $info = 'a tiempo';
            $color = '00B347';
        } else {
            $info = 'vence hoy';
            $color = 'F0FF32';
        }

        $sheetActive->getStyle($celdas)->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB($color);

        return $info;
    }

    $index = 1;
    $sheet = 3;

    foreach ($contractual_processes as $cp) {

        $sheetActive->setCellValue("A{$sheet}", $index);
        $sheetActive->setCellValue("B{$sheet}", $cp['nomenclature']);
        $sheetActive->setCellValue("C{$sheet}", $cp['entity']);
        $sheetActive->setCellValue("D{$sheet}", $cp['nombre']);
        $sheetActive->setCellValue("E{$sheet}", $cp['value']);
        $sheetActive->setCellValue("F{$sheet}", $cp['prepliego_date_presentation']);
        $sheetActive->setCellValue("G{$sheet}", compareDate($cp['prepliego_date_presentation'], $sheetActive, "E{$sheet}:G{$sheet}"));
        $sheetActive->setCellValue("H{$sheet}", $cp['pliego_date']);
        $sheetActive->setCellValue("I{$sheet}", $cp['pliego_date_presentation']);
        $sheetActive->setCellValue("J{$sheet}", compareDate($cp['pliego_date_presentation'], $sheetActive, "H{$sheet}:L{$sheet}"));
        $sheetActive->setCellValue("K{$sheet}", $cp['pliego_date_presentation']);
        $sheetActive->setCellValue("L{$sheet}", compareDate($cp['pliego_date_presentation'], $sheetActive, "H{$sheet}:L{$sheet}"));
        $sheetActive->setCellValue("M{$sheet}", $cp['offer_date_presentation']);
        $sheetActive->setCellValue("N{$sheet}", compareDate($cp['offer_status'], $sheetActive, "M{$sheet}:N{$sheet}"));

        $sheet++;
        $index++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $today = date("d/m/y");

    $fecha = new DateTime();

    $nameFile = "{$fecha->getTimestamp()}.xlsx";
    $writer->save($nameFile);

    $mail = new PHPMailer(true);

    try {
        //Server settings for Godaddy
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'a2plcpnl0009.prod.iad2.secureserver.net';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'soportetc-consultorias@licitacionestc.com.co';
        $mail->Password   = 'tcconsultorias2019';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom('serranocamilo95@gmail.com', 'Soporte TC Consultorias');
        $email = 'casegica@gmail.com';
        $mail->addAddress($email);
        
        // Attachments
        $mail->addAttachment($nameFile);

        // Content
        $mail->Subject = 'Notificacion de Procesos Contractuales para el dia de hoy';
        $mail->Body    = "Aqui va el excel con los procesos, enviado desde el server";
        $mail->send();

        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    unset($spreadsheet);
?>