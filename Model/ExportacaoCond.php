<?php


class ExportacaoCond
{
    public function excel($queryExp, $Nome, $data1, $data2)
    {
// Incluimos a classe PHPExcel
        include '../phpexcel/Classes/PHPExcel.php';
// Instanciamos a classe
        $objPHPExcel = new PHPExcel();

// Definimos o estilo da fonte
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true)
            ->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)
            ->getActiveSheet()->getStyle('C1')->getFont()->setBold(true)
            ->getActiveSheet()->getStyle('D1')->getFont()->setBold(true)
            ->getActiveSheet()->getStyle('E1')->getFont()->setBold(true)
            ->getActiveSheet()->getStyle('F1')->getFont()->setBold(true)
            ->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);

// Criamos as colunas

        if ($Nome == NULL){

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NENHUM REGISTRO ENCONTRADO');

        }else {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Operação')
                ->setCellValue('B1', " Cliente")
                ->setCellValue("C1", "CPF/CNPJ")
                ->setCellValue("D1", "Lote")
                ->setCellValue("E1", "Dt. Vcto.")
                ->setCellValue("F1", "Vlr. Dívida")
                ->setCellValue("G1", "Banco Nome");

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        }
        $linha = 2;
            while ($row = ibase_fetch_object($queryExp)) {
                $objPHPExcel
                    ->setActiveSheetIndex(0)
                    ->setCellValue("A" . $linha, $row->OPERACAO)
                    ->setCellValue("B" . $linha, utf8_encode($row->CLIENTE))
                    ->setCellValue("C" . $linha, $row->CPF)
                    ->setCellValue("D" . $linha, utf8_encode($row->LOTE))
                    ->setCellValue("E" . $linha, $row->DATAVENC)
                    ->setCellValue("F" . $linha, $row->DIVIDA)
                    ->setCellValue("G" . $linha, utf8_encode($row->BANCO));
                $linha++;
            }

// Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
        $objPHPExcel->getActiveSheet()->setTitle('Arquivo');

// Cabeçalho do arquivo para ele baixar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename= '.utf8_decode($Nome)." - ".$data1." - ".$data2.'.xls');
        header('Cache-Control: max-age=0');
// Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');

// Acessamos o 'Writer' para poder salvar o arquivo
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
        $objWriter->save('php://output');

        exit;

    }

}