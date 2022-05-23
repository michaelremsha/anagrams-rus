<?php
if ($argc === 2) {
    $input = $argv[1];
    $url = "https://raw.githubusercontent.com/danakt/russian-words/master/russian.txt";
    $vocab = explode("\n", file_get_contents(($url), true));
    $answer = array();

    $str = mb_convert_encoding($input, "UTF-8", "CP1251");
    echo $str;

    function create_dictionary($word){
        $dict = array();
        foreach (str_split($word) as $letter){
        
            if(isset($dict[$letter])){
                $dict[$letter] += 1;
            } else {
                $dict[$letter] = 1;
            }
            
        }
        return $dict;
    }

    function compare_dict($case,$keyword){
        $possible = FALSE;

        foreach($case as $key=>$value){
            if(!isset($keyword[$key]) or $keyword[$key]<$value){
                $possible = FALSE;
                break;
            } else {
                $possible = TRUE;
            }
        }
        return $possible;
    }

    $keyword = create_dictionary($input);

    foreach($vocab as $word){
        $possible = compare_dict(create_dictionary($word),$keyword);
        if($possible){
            $str = mb_convert_encoding($word, "UTF-8", "CP1251");
            array_push($answer, $str);
        }

    }
    print_r($answer);

} elseif($argc < 2){
    echo('no variable input');
} else{
    echo('too many arguments');
}
?>