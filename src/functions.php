<?php

function task1()
{
    $xml = simplexml_load_file (__DIR__ . "/data.xml");
    echo $xml->getName().'<br/><br/>';
    echo "PurchaseOrderNumber".':'.(string)$xml["PurchaseOrderNumber"]."<br/><br/>";

    echo $xml->Address[0]->getName().'('.$xml->Address[0]->attributes().')'.':'.'<br/>';
    echo $xml->Address[0]->Name->getName().':  '.$xml->Address[0]->Name.'<br/>';
    echo $xml->Address[0]->Street->getName().':  '.$xml->Address[0]->Street.'<br/>';
    echo $xml->Address[0]->City->getName().':  '.$xml->Address[0]->City.'<br/>';
    echo $xml->Address[0]->State->getName().':  '.$xml->Address[0]->State.'<br/>';
    echo $xml->Address[0]->Zip->getName().':  '.$xml->Address[0]->Zip.'<br/>';
    echo $xml->Address[0]->Country->getName().':  '.$xml->Address[0]->Country.'<br/><br/><br/>';

    echo $xml->Address[1]->getName().'('.$xml->Address[1]->attributes().')'.':'.'<br/>';
    echo $xml->Address[1]->Name->getName().':  '.$xml->Address[1]->Name.'<br/>';
    echo $xml->Address[1]->Street->getName().':  '.$xml->Address[1]->Street.'<br/>';
    echo $xml->Address[1]->City->getName().':  '.$xml->Address[1]->City.'<br/>';
    echo $xml->Address[1]->State->getName().':  '.$xml->Address[1]->State.'<br/>';
    echo $xml->Address[1]->Zip->getName().':  '.$xml->Address[1]->Zip.'<br/>';
    echo $xml->Address[1]->Country->getName().':  '.$xml->Address[1]->Country.'<br/><br/><br/>';

    echo $xml->DeliveryNotes->getName().'<br/>'.$xml->DeliveryNotes.'<br/><br/><br/>';

    echo $xml->Items->getName().':'.'<br/><br/>';
    echo $xml->Items->Item[0]->attributes()->getName().':'.$xml->Items->Item[0]->attributes().'<br/>';
    echo $xml->Items->Item[0]->ProductName->getName().':'.$xml->Items->Item[0]->ProductName.'<br/>';
    echo $xml->Items->Item[0]->Quantity->getName().':'.$xml->Items->Item[0]->Quantity.'<br/>';
    echo $xml->Items->Item[0]->USPrice->getName().':'.$xml->Items->Item[0]->USPrice.'<br/>';
    echo $xml->Items->Item[0]->Comment->getName().':'.$xml->Items->Item[0]->Comment.'<br/><br/>';

    echo $xml->Items->Item[1]->attributes()->getName().':'.$xml->Items->Item[1]->attributes().'<br/>';
    echo $xml->Items->Item[1]->ProductName->getName().':'.$xml->Items->Item[1]->ProductName.'<br/>';
    echo $xml->Items->Item[1]->Quantity->getName().':'.$xml->Items->Item[1]->Quantity.'<br/>';
    echo $xml->Items->Item[1]->USPrice->getName().':'.$xml->Items->Item[1]->USPrice.'<br/>';
    echo $xml->Items->Item[1]->ShipDate->getName().':'.$xml->Items->Item[1]->ShipDate.'<br/><br/>';
}

//=========================================================================
function task2()
{
    $data = [
        ['Russia','USA','Ispain','France','German'],
        ['Audi','Mersedes','Opel','BMW','Lada','Toyota'],
        ['Benetto','Azimut','Shimano','Aist','Zenith','Bronx'],
    ];

    $text_json = json_encode($data);
    $filename='output.json';
    $filename2='output2.json';



    file_put_contents($filename, $text_json);
    $file = file_get_contents($filename);
    $decode = json_decode($file, true);



    $a = rand(1, 100);
    if ($a<=50) {
        array_unshift($decode, "Hello", "......again");
    }



    $text_json2 = json_encode($decode);
    file_put_contents($filename2, $text_json2);



    $file1 = file_get_contents($filename);
    $file2 = file_get_contents($filename2);




    $jsonms1 = json_decode($file1, true);
    $jsonms2 = json_decode($file2, true);



    $result = array_diff($jsonms2, $jsonms1);

    if ($result === []) {
        echo "Без изменений";
    } else {
        echo "Новые данные были обнаружены<br/>";
        print_r($result);
    }
}
//==============================================================================

function task3()
{
    for ($i = 1; $i <= 50; $i++) {
        $arr[$i] = rand(1, 100);
    }

    $fp = fopen('./test.csv', 'w');

    fputcsv($fp, $arr, ';');

    fclose($fp);


    $fp1 = fopen('./test.csv', 'r');
    if ($fp1) {
        $list=[];
        while (($csvData = fgetcsv($fp1, 5000, ";")) !==false) {
            $list[] = $csvData;
        }
        $result=0;
        foreach ($list[0] as $elem) {
            if (($elem%2)==0) {
                $result+=$elem;
            }
        }
        echo $result;
    }
}
//===============================================================================
function task4()
{
    $data = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');
    $decoded = json_decode($data, true);

    $params = ["title", "pageid"];

    $result = array_shift($decoded["query"]["pages"]);

    foreach ($params as $value) {
        echo "<br>", $value . " = " . $result[$value];
    }
}
