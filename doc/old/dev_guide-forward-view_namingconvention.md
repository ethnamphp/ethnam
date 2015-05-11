# ビュー定義省略時の命名規則を変更する

## ビュー定義省略時の命名規則を変更する

遷移先定義が省略された場合\*1、以下の4つのファイル名またはクラス名が暗黙のうちに決定されます。

- ビュークラスが定義されたファイルのパス名
- ビュークラス名

これらの命名規則は、Ethna_Controllerに定義されている以下のメソッドをオーバーライドすることで変更することが出来ます。

<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>ビュークラスが定義されたファイルのパス名</dt>
<dd>Ethna_Controller::getDefaultViewPath($forward_name, $fallback)</dd>
<dt>ビュークラス名</dt>
<dd>Ethna_Controller::getDefaultViewClass($forward_name, $fallback)</dd>
</dl>

Ethna_Controllerでは、パス名は

    $default_path = preg_replace('/_(.)/e', "'/' . strtoupper('\$1')", ucfirst($forward_name)) . '.' . $this->getExt('php');

つまり"foo_bar_hoge" -> "Foo/Bar/Hoge.php"となり、ビュークラス名は

    $postfix = preg_replace('/_(.)/e', "strtoupper('\$1')", ucfirst($forward_name));
    ...
    $r = sprintf("%s_View_%s", $this->getAppId(), $postfix);

となります。好みに応じて適宜オーバーライドしてください(それほどお勧めはしません)。

例えば、"foo_bar_hoge"というビュークラスに対応するファイル名を"foo_bar_hoge.php"にして、遷移名を"foo_bar_hoge_view"としたい場合は、以下のアプリケーションのコントローラに以下のような定義を追加します。

Sample_Controller.php:

    /**
     * 遷移名に対応するビューパス名が省略された場合のデフォルトパス名を返す
     *
     * @access public
     * @param string $forward_name 遷移名
     * @param bool $fallback クライアント種別によるfallback on/off
     * @return string ビュークラスが定義されるスクリプトのパス名
     */
    function getDefaultViewPath($forward_name, $fallback = true)
    {
        return $forward_name . ".php";
    }

    /**
     * 遷移名に対応するビュークラス名が省略された場合のデフォルトクラス名を返す
     *
     * @access public
     * @param string $forward_name 遷移名
     * @param bool $fallback クライアント種別によるfallback on/off
     * @return string ビュークラス名
     */
    function getDefaultViewClass($forward_name, $fallback = true)
    {
        return $forward_name . "_view";
    }

なお2番目の引数$fallbackは、現在アクティブなクライアントタイプ(PCブラウザ、i-mode、SOAP、etc...)に応じてデフォルト値を変更した場合等に使用しますが、とりあえず無視して頂いてOKです。


* * *
\*1 [遷移先定義を省略する](dev_guide-forward-omit.md)を参照  

