<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resultados da Busca na Web</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/Acesso_Acervo.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">
                <img src="img/logompec.png" alt="">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li>
              <a href="index.html">Início</a>
          </li>
          <li>
              <a href="Acesso_Acervo.html">Acesso ao Acervo</a>
          </li>
          <li>
              <a href="Servico_Avaliacao.html">Serviço de Avaliação</a>
          </li>
          <li>
              <a href="Servico_Autoarquivamento.html">Autoarquivamento</a>
          </li>
          <li>
              <a href="sobre.html">Sobre a Biblioteca</a>
          </li>
          <li>
              <a href="Administracao.html">Administração</a>
          </li>
          <li>
              <a href="contato.html">Contato</a>
          </li>
      </ul>
  </div>
  <!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
        <legend>Resultados da Busca na Web</legend>
        <?php
        require_once 'PDF2Text.php';
        require_once 'searchMachine.php';
        header('Content-Type: text/html; charset=ISO-8859-1');


        function hanking($docs, $keywords, $filter = 0, $textOp = 0) 
        {
            $terms = explode(' ', $keywords);
    //print_r($terms);
            if($filter == 1)
            {
                $results =  cosine($terms, $docs, $keywords, $textOp);
                uasort($results, "comp");
                return $results;
            }
            else if($filter == 2)
            {
                $results = jaccard($terms, $docs, $keywords, $textOp);
                uasort($results, "comp");
                return $results;
            }
            else {return $docs;}
        }

        function comp($a, $b)
        {
            if($a['cosine'] == $b['cosine'])
            {
                return 0;
            }
            return ($a['cosine'] > $b['cosine']) ? -1 : 1;
        }

        function codificacao($string) 
        {
            return mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
        }

        function parseUtf8ToIso88591(&$string){
           if(!is_null($string)){
            $iso88591_1 = utf8_decode($string);
            $iso88591_2 = iconv('UTF-8', 'ISO-8859-1', $string);
            $string = mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');       
        }
    }

    function getIndex($docs, $keywords, $op=0) {
        $collection = array();
        //echo 'OK OK OK OK OK <br>';
        //$querySplit = explode(' ', $keywords);
        array_push($collection, $keywords);
        //echo count($docs);
        $i = 0;
        foreach($docs as $document)
        {
            $url = $document['urlEncode'];  
            if($op == 0)
            {
                $text = $document['title'] . ' ' . $document['content'];
                if (mb_detect_encoding($text.'x', 'UTF-8, ISO-8859-1') != 'UTF-8')
                    $text = utf8_encode ($text);
            //    $text = cleanString($text);
                $text = preg_replace('/[^a-zA-Z ]/', '', $text);
            }
            else if($op == 1)
            {
                    if($i == 37) $text = ''; // || ($i==7) || ($i==13) || ($i==20) || ($i==24)
                    else $text = extractTextFromPDF($url);
                }
                else {
                    $text = $document['title'] . ' ' . $document['content'];
                    if (mb_detect_encoding($text.'x', 'UTF-8, ISO-8859-1') != 'UTF-8')
                        $text = utf8_encode ($text);
                    $text = cleanString($text);
                    $text = preg_replace('/[^a-zA-Z ]/', '', $text);
                    
                if($i == 37) $text .= ''; // || ($i==7) || ($i==13) || ($i==20) || ($i==24)
                else $text .= ' ' . extractTextFromPDF($url);
                
            }
            
            array_push($collection, $text);
            unset($text);
            $i++;
        }
        
        $dictionary = array();
        $docCount = array();
        $maxFreq = array();
        for($i=0;$i<count($collection);$i++)
        {
           $aux = array('term' => '', 'value' => 0);
           array_push($maxFreq, $aux);
       }
       
       foreach($collection as $docID => $doc) {
        $terms1 = array();
        $terms = explode(' ', $doc); 
        foreach($terms as $term)
        {
            if (strlen($term)>2) {
                array_push($terms1, $term);
            }
        }
        $terms = $terms1;
        
                //print_r($terms);
        $docCount[$docID] = count($terms);
                //echo '<br>'.$docCount[$docID] . '<br>';
        foreach($terms as $term) {
            $term = strtolower($term);
            if(!isset($dictionary[$term])) {
                $dictionary[$term] = array('df' => 0, 'postings' => array());
            }
            if(!isset($dictionary[$term]['postings'][$docID])) {
                $dictionary[$term]['df']++;
                $dictionary[$term]['postings'][$docID] = array('tf' => 0, 'weight' => 0);
            }

            $dictionary[$term]['postings'][$docID]['tf']++;
                       //if(strlen($term)>1)
                       //{
            if($dictionary[$term]['postings'][$docID]['tf'] > $maxFreq[$docID]['value'])
            {
                $maxFreq[$docID]['value'] = $dictionary[$term]['postings'][$docID]['tf'];
                $maxFreq[$docID]['term'] = $term;
            }
                        //}
        }
    }
    return array('docCount' => $docCount, 'dictionary' => $dictionary, 'maxFreq' => $maxFreq); 
}

function cosine($terms, $docs1, $keywords, $textExtractionOP = 0) {
    $docs = $docs1;
    $index = getIndex($docs, $keywords, $textExtractionOP);
        $docCount = count($index['docCount']); // conta numero de documentos
        $maxFreq = $index['maxFreq'];
        //echo "................................NUM DOCS..........." . $docCount . '<br>';
        $w = 0; $d = array();
        for($i=0; $i<$docCount; $i++) {array_push($d, 0);}
            foreach ($terms as $term) {
                if(strlen($term)>2)
                {
                    $term = strtolower($term);
                $entry = $index['dictionary'][$term];// le todos os termos de todos os documentos
                foreach($entry['postings'] as  $docID => $postings) {
                    if($docID == 0)
                        {$index['dictionary'][$term]['postings'][$docID]['weight'] = ((0.5 + 0.5*($postings['tf']/$maxFreq[$docID]['value'])) * log($docCount / $entry['df'], 2));}
                    else
                        {$index['dictionary'][$term]['postings'][$docID]['weight'] = (($postings['tf']/$maxFreq[$docID]['value']) * log($docCount / $entry['df'], 2));
                }
                $w = $index['dictionary'][$term]['postings'][$docID]['weight'];
                $d[$docID] = $d[$docID] + $w*$w;
                if($docID > 0)
                    $docs[$docID-1]['cosine'] += $index['dictionary'][$term]['postings'][0]['weight']*$w;
            }
        }
    }
        $d[0] = sqrt($d[0]); //linha adicionada por ultimo
        for($i=0; $i < $docCount-1; $i++)
        {
            //echo '<br>Doc ' . $i . ': '.$docs[$i]['cosine'].'<br>';
            $d[$i+1] = sqrt($d[$i+1]);
            if($d[$i+1]*$d[0] != 0)
            {
                $docs[$i]['cosine'] = $docs[$i]['cosine']/($d[$i+1]*$d[0]);
            }
            else  {$docs[$i]['cosine'] = 0;}
        }
        //print_r($docs);*/
        return $docs;    
    }

    function jaccard($terms, $docs1, $keywords, $textExtractionOP = 0) {
        $docs = $docs1;
        $index = getIndex($docs, $keywords, $textExtractionOP);
        $docCount = count($index['docCount']); // conta numero de documentos
        $maxFreq = $index['maxFreq'];
        $w = 0; $d = array();
        for($i=0; $i<$docCount; $i++) {array_push($d, 0);}
            foreach ($terms as $term) {
                if(strlen($term)>2)
                {
                $entry = $index['dictionary'][strtolower($term)];// le todos os termos de todos os documentos
                foreach($entry['postings'] as  $docID => $postings) {
                    if($docID == 0)
                        $index['dictionary'][$term]['postings'][$docID]['weight'] = ((0.5 + 0.5*($postings['tf']/$maxFreq[$docID]['value'])) * log($docCount / $entry['df'], 2));
                    else
                        $index['dictionary'][$term]['postings'][$docID]['weight'] = (($postings['tf']/$maxFreq[$docID]['value']) * log($docCount / $entry['df'], 2));
                    $w = $index['dictionary'][$term]['postings'][$docID]['weight'];
                    $d[$docID] = $d[$docID] + $w*$w;
                    if($docID > 0)
                        $docs[$docID-1]['cosine'] += $index['dictionary'][$term]['postings'][0]['weight']*$w;
                }
            }
        }
        for($i=0; $i < $docCount-1; $i++)
        {
            if(($d[$i+1] + $d[0] - $docs[$i]['cosine']) != 0)
            {
                $docs[$i]['cosine'] = $docs[$i]['cosine']/($d[$i+1] + $d[0] - $docs[$i]['cosine']);
            }
            else  {$docs[$i]['cosine'] = 0;}
        }
        return $docs;
    }

    function calculaNormaQuery($queryWeights)
    {
        $dk = 0;
        foreach ($queryWeights as $w) 
        {
            $dk += $w*$w; 
        }
        $d = sqrt($dk);
        return $d;
    }

    function getTFquery($terms)
    {
        $queryWeights = array();
        foreach ($terms as $term) {
            $queryWeights[$term] = 0;
        }
        foreach ($terms as $term) {
            $queryWeights[$term]++;
        }
        return $queryWeights;
    }


    function filtro($keywords, $query, $motores = array(true,false,false,false), $numPages = 1, $filter = 0, $textOP = 0)
    {
        $retorno = \extrator_mix($keywords, $numPages, $motores);
        $retornoG = [];
        $retornoB = [];
        $retornoY = [];
        $retornoS = [];
        $docs=[];
        $i = 0;

        foreach($retorno as $item)
        {   
            if($item['fonte'] == 'Google Search')
            {
                array_push($retornoG, $item);
                $i++;
                if($i==10)
                {
                    $docsG = hanking($retornoG, $query, $filter, $textOP);
                    $docs = array_merge($docs, $docsG);
                    $retornoG = array();
                    $i=0;
                }
            }
            if($item['fonte'] == 'Bing')
                array_push($retornoB, $item);
                $i++;
                if($i==10)
                {
                    $docsG = hanking($retornoG, $query, $filter, $textOP);
                    $docs = array_merge($docs, $docsG);
                    $retornoG = array();
                    $i=0;
                }
            if($item['fonte'] == 'Yahoo')
                array_push($retornoY, $item);
            if($item['fonte'] == 'Google Scholar')
                array_push($retornoS, $item);
        }
        
        
        $docsG = hanking($retornoG, $query, $filter, $textOP);
        $docsB = hanking($retornoB, $query, $filter, $textOP);
        $docsY = hanking($retornoY, $query, $filter, $textOP);
        $docsS = hanking($retornoS, $query, $filter, $textOP);
        $docs = array_merge($docs,$docsG, $docsB, $docsY, $docsS);
        return $docs;
    }

    function test1()
    {
        $titulo = '';
        $titulo .= strtolower('Esta monografia apresenta uma proposta para a confecção de uma biblioteca digital voltada para a organização e o armazenamento, a princípio, de trabalhos monográficos do Departamento de Computação (DECOM) da Universidade Federal de Ouro Preto (UFOP) Banco de dados Biblioteca digital Dublin core Protocolo OAI-PMH');
        $keywords = array('"Banco de dados"', '"Biblioteca digital"', '"Dublin core"', '"Protocolo OAI-PMH"');
        $resultadoSites = \filtro($keywords, $titulo, array(true,false,false,false), 2, 1, 0);
 //   echo '<br><br><br><br>';
        $i = 1;
        foreach($resultadoSites as $item) {
            echo '<b>Título: </b>' . $item['title'] . '<br>';
            echo "<b>URL: </b> <a href=\"$item[urlEncode]\"><u> <font color=\"#0000FF\">$item[urlEncode]" . "</font></u><br /></a>";
            echo '<b>Descrição: </b>' . $item['content'] . '<br>' . '<hr>';
      //  echo $item['cosine'] . '<br>' . '<br>';
            $i++;
        }
    }

//test1();

    ?>
</div>
</div>
</div>
</body>
</html>