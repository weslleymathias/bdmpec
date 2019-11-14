<?php
include './simplehtmldom_1_5/simple_html_dom.php';
header('Content-Type: text/html; charset=ISO-8859-1');

class searchMachine{
    var $document = '';
    
    function extrator_google($keywords, $numPages, &$resultados)
    {
        //$resultados = array();
        $url = "http://www.google.com.br/search?q=";
        $urls = array();
        $words = "";
        foreach($keywords as $word)
        {
            $word = str_replace('author:', '', $word);
            if(next($keywords))
            {
                $words = $words . $word . '+';
            }
            else 
            {
                $words = $words . $word;
            }
        }
        for($i=1; $i<=$numPages; $i++)
        {
            $urli = $url . $words . '+filetype:pdf&start='.($i-1)*10;
            $urli = str_replace(' ', '+', $urli);
            //echo $urli;
            array_push($urls, $urli);
        }
        foreach($urls as $ur)
        {
            //$ur = urlencode($ur);
            $this->document = new simple_html_dom();
            $this->document->load_file($ur);
            foreach($this->document->find('.g') as $element) 
            {
                $pag = array('title' => ' ', 'url' => ' ', 'urlEncode' => ' ', 'content' => ' ', 'cosine' => 0, 'fonte' => 'Google Search');
                foreach($element->find('.r') as $title) 
                {
                    foreach($title->find('a') as $a)
                    {
                        $pag['title'] = $a->plaintext;
                        //$pag['urlEncode'] = $a->original_target;
                        $href = explode('url?q=', $a->href);
                        $href2 = explode('.pdf', $href[1]);
                        $pag['urlEncode'] = urldecode($href2[0]) . '.pdf';
                    }
                }
                

                foreach($element->find('.s') as $text) 
                {   
                    foreach($text->find('cite') as $u)
                        { $pag['url'] = $u->plaintext;}
                    foreach($text->find('.st') as $content)
                    { 
                        $pag['content'] = $content->plaintext;  
                    }
                }
                if(in_docs($pag['urlEncode'], $resultados) == false)
                    {array_push($resultados, $pag); }    
            }
        }
        //return $resultados;
    }
    
    function extrator_bing($keywords, $numPages, &$resultados)
    {
        //$resultados = array();
        $url = "http://www.bing.com.br/search?q=";
        $urls = array();
        $words = "";
        foreach($keywords as $word)
        {
            $word = str_replace('author:', '', $word);
            if(next($keywords))
            {
                $words = $words . $word . '+';
            }
            else 
            {
                $words = $words . $word;
            }
        }
        for($i=1; $i<=$numPages; $i++)
        {
            $urli = $url . $words . '+filetype:pdf&first='.( 1 + (10*($i-1)));
            $urli = str_replace(' ', '+', $urli);
            array_push($urls, $urli);
        }
        foreach($urls as $ur)
        {
            $this->document = new simple_html_dom();
            $this->document->load_file($ur);
            foreach($this->document->find('.b_algo') as $element) 
            {
                $pag = array('title' => ' ', 'url' => ' ', 'urlEncode' => ' ', 'content' => ' ', 'cosine' => 0, 'fonte' => 'Bing');
                foreach($element->find('h2 a') as $a)
                {
                    $pag['title'] = $a->plaintext;
                    $pag['urlEncode'] = $a->href;
                    //$href = explode('url?q=', $a->href);
                    //$href2 = explode('.pdf', $href[1]);
                    //$pag['urlEncode'] = urldecode($href2[0]) . '.pdf';
                }


                foreach($element->find('.b_caption') as $text) 
                {   
                    foreach($text->find('div.b_attribution cite') as $u)
                        { $pag['url'] = $u->plaintext;}
                    foreach($text->find('p') as $content)
                    { 
                        $pag['content'] = $content->plaintext;  
                    }
                }
                if(in_docs($pag['urlEncode'], $resultados) == false)
                    {array_push($resultados, $pag); }    
            }
        }
        //return $resultados;
    }
    
    function extrator_yahoo($keywords, $numPages, &$resultados)
    {
        //$resultados = array();
        $url = "https://br.search.yahoo.com/search?q=";
        $urls = array();
        $words = "";
        foreach($keywords as $word)
        {
            $word = str_replace('author:', '', $word);
            if(next($keywords))
            {
                $words = $words . $word . '+';
            }
            else 
            {
                $words = $words . $word;
            }
        }
        for($i=1; $i<=$numPages; $i++)
        {
            $urli = $url . $words . '+filetype:pdf&b='.( 1 + (10*($i-1)));
            $urli = str_replace(' ', '+', $urli);
            array_push($urls, $urli);
        }
        foreach($urls as $ur)
        {
            $this->document = new simple_html_dom();
            $this->document->load_file($ur);
            foreach($this->document->find('.res') as $element) 
            {
                $pag = array('title' => ' ', 'url' => ' ', 'urlEncode' => ' ', 'content' => ' ', 'cosine' => 0, 'fonte' => 'Yahoo');
                foreach($element->find('div h3') as $h3) 
                {
                    foreach($h3->find('a') as $a)
                    {
                        $pag['urlEncode'] = $a->href;
                        $pag['title'] = $a->plaintext;
                    }
                }
                $pag['url'] = $element->find('span.url',0)->plaintext;
                $pag['content']  = $element->find('.abstr',0)->plaintext;
                if(in_docs($pag['urlEncode'], $resultados) == false)
                    {array_push($resultados, $pag); }
            }
        }
        //return $resultados;
    }
    
    function extrator_scholar($keywords, $numPages, &$resultados)
    {
        //$resultados = array();
        $url = "https://scholar.google.com.br/";
        $urls = array();
        $words = "";
        foreach($keywords as $word)
        {
            if(next($keywords))
            {
                $words = $words . $word . '+';
            }
            else 
            {
                $words = $words . $word;
            }
        }
        for($i=1; $i<=$numPages; $i++)
        {
            $urli = $url . 'scholar?start='.($i-1)*10 . '&q=' . $words . '+filetype:pdf';
            $urli = str_replace(' ', '+', $urli);
            array_push($urls, $urli);
        }
        foreach($urls as $ur)
        {
            $this->document = new simple_html_dom();
            $this->document->load_file($ur);
            foreach($this->document->find('.gs_ri') as $element) 
            {
                $pag = array('title' => ' ', 'url' => ' ', 'urlEncode' => ' ', 'content' => ' ', 'cosine' => 0, 'fonte' => 'Google Scholar');       
                $title = $element->find('.gs_rt', 0);
                $type = $title->find('span.gs_ct1', 0);//->find('.gs_ct1', 0);
                $t = utf8_decode($type->plaintext);
                if($t[1] == 'P' && $t[2] == 'D' && $t[3] == 'F')
                {
                   $pag['title'] = $title->plaintext;
                   $pag['urlEncode'] = $element->find('.gs_rt a', 0)->href;
                   $pag['url'] = $pag['urlEncode'];
                   $pag['content'] = $element->find('.gs_rs', 0)->plaintext;
                   if(in_docs($pag['urlEncode'], $resultados) == false)
                    {array_push($resultados, $pag); }
            }   
        }
    }
        //return $resultados;
}
}

function extrator_mix($keywords, $numPages, $motores_busca)
{
    $a = new searchMachine();
    $resultados = array();
    if($motores_busca[0] == true)
        $a->extrator_google($keywords, $numPages, $resultados);
    if($motores_busca[1] == true)
        $a->extrator_bing($keywords, $numPages, $resultados);
    if($motores_busca[2] == true)
        $a->extrator_yahoo($keywords, $numPages, $resultados);
    if($motores_busca[3] == true)
        $a->extrator_scholar($keywords, $numPages, $resultados);
    return $resultados;
}

function in_docs($url, $docs)
{
    $url = str_replace('www.', '', $url);
    foreach($docs as $doc)
    {
        $url2 = str_replace('www.', '', $doc['urlEncode']);
        if($url == $url2)
            return true;
    }
    return false;
}

function turnToText($text)
{
    $txt = "";
    for($i=0; $i<strlen($text); $i++)
    {
        $txt = $txt . $text[$i];
    }
    return $txt;    
}

function test()
{
    //$a = new searchMachine();
    $motores_busca = array(false, false, false, true);
    $queryOptions = array(false,true,false,false);
    $ret = getQuery($queryOptions, array('palavrasChave' => array('Banco de dados', 'Biblioteca digital', 'Dublin core', 'Protocolo OAI-PMH')));
    $ret = extrator_mix($ret['keywords'], 1, $motores_busca);
    
    foreach($ret as $pag)
    {
        echo utf8_decode($pag['title']) . '<br>';
        echo $pag['urlEncode'] . '<br>';
        echo utf8_decode($pag['content']) . '<br>';
        echo $pag['fonte'] . '<br>';
        echo '<br><br>';
    }
}

//$a = test();

?>