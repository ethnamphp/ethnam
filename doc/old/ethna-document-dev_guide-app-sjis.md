# EthnaでShift_JISなサイトを作る
* * *

書いた人:cocoiti

* * *

### 概要 [](ethna-document-dev_guide-app-sjis.html#h7e429fc "h7e429fc")

Ethnaは、内部コードがutf-8でできています。(変換かければ、どうにでもなりますが)。  
基本的に問題はないのですが、携帯サイトなどを作る時に、やむえず、出力をShift\_JISにしたくなるときがあります。

その方法について記述していきます。

なお、以下のポリシーで記述しています。

- 内部コードはutf-8
- 入力コードはShift\_JIS(自動判別のフィルタを書く方法は別途記述）
- 出力コードはShift\_JIS(sjis-win)

### 内部コードはutf-8で書く [](ethna-document-dev_guide-app-sjis.html#r1470ae9 "r1470ae9")

各種テンプレート（HTML、メール）も含め通常通り、utf-8で記述します。

### 入力のShift\_JISを内部コードに変換 [](ethna-document-dev_guide-app-sjis.html#m4997005 "m4997005")

まずは、Ethnaのフィルタで入力コードを変換してしまいます。

    function preFilter()
    {
        $_POST = InputEncoding($_POST);
        $_GET = InputEncoding($_GET);
    }
    (省略)
    
    function InputEncoding($data)
    {
        static $encoding = null;
        static $internal_encoding = null;
        if (is_null($encoding)) {
            $encoding = 'sjis-win';
        }
    
        if (is_null($internal_encoding)) {
            $internal_encoding = 'eucjp-win';
        }
    
        if (is_array($data)) {
            return array_map('InputEncoding', $data);
        }else{
            return mb_convert_encoding($data, $internal_encoding, $encoding);
        }
     }

こんな感じで、sjis-win => euc-winに変換します。

### 出力コードを変換する [](ethna-document-dev_guide-app-sjis.html#eac25063 "eac25063")

Smartyフィルタで、出力コードをShift\_JISにしてしまいます。

    function smarty_outputfilter_encode($output, &$smarty){
        return mb_convert_encoding($output, "SJIS-win", "eucJP-win");
    }

これでWeb上の文字コードはShift\_JISになります。

- これの代わりにprefilter()でmb\_http\_output("SJIS");mb\_internal\_encoding("utf-8");をするのはありでしょうか？ (n071316)

### コントローラに追加する [](ethna-document-dev_guide-app-sjis.html#s176e6e2 "s176e6e2")

変換コードを書いたら、それをappやlibに保存して、プロジェクトのコントローラの先頭部分でrequireしましょう。

### MailSenderのSmartyでフィルタが有効になっている問題 [](ethna-document-dev_guide-app-sjis.html#v17b7aef "v17b7aef")

通常なら、上記までで十分なのですが、Ethna 0.2.0までの全てのバージョンは、Ethna\_MailSenderにおいて、Smartyを使用しています。

これはこれでかまわないのですが、先ほどのSmartyフィルタが有効になっているため、utf-8 => sjis-winと変換されメール送信アルゴリズムが動作します。\*1

さらにここまでもまぁ問題ないのですが、運がわるいことに、Ethna\_MailSernder::\_parse()がShift\_JISだとうまくパースできない場合があるので\*2、これをutf-8に戻してやります。

幸いにもEthna\_MailSenderは継承して使用するのが基本なので、継承したついでに継承後のクラスに以下を追記します。

    function _parse($mail)
    {
        $mail = mb_convert_encoding($mail, "eucjp-win", "sjis-win");
        return parent::_parse($mail);
    }

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1これはこれで、まずいと思う。  
\*2無限ループっぽくなる。詳しくは追ってない。  

<!-- ??END id:note -->
