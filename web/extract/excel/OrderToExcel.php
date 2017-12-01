<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 01/12/2017 16:58                */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
if (!SecurityManager::get()->isAuthentified($_SESSION) || !isset($_SESSION['orderId'])) {
    header('Location:'.SERVER_URL.WEB_PATH.'404');
}

$workBook = new PHPExcel;
$workBook->getProperties()->setCreator("Annie Gagnon");
$workBook->setActiveSheetIndex(0);
$workSheet=$workBook->getActiveSheet();

// ajout des données dans la feuille de calcul
$workSheet->setTitle('Nom affiché dans l\'onglet');
$workSheet->setCellValueByColumnAndRow(0, 1, 'Les colonnes débutent à 0 et les lignes débutent à 1');
$workSheet->SetCellValue('A2', 'Il est aussi possible d\'utiliser la notation LettreChiffre (ex : A2)');

// envoi du fichier au navigateur
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="nomfichier.xlsx"');
header('Cache-Control: max-age=0');
$writer = PHPExcel_IOFactory::createWriter($workBook, 'Excel2007');
$writer->save('php://output');