# アクション定義省略時の命名規則を変更する

## アクション定義省略時の命名規則を変更する [](ethna-document-dev_guide-action-namingconvention.html#g2951490 "g2951490")

アクション定義が省略された場合\*1、以下の4つのファイル名またはクラス名が暗黙のうちに決定されます。

- アクションクラスが定義されたファイルのパス名
- アクションクラス名
- アクションフォームが定義されたファイルのパス名
- アクションフォーム名

これらの命名規則は、Ethna\_Controllerに定義されている以下のメソッドをオーバーライドすることで変更することが出来ます。

<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>アクションクラスが定義されたファイルのパス名</dt>
<dd>Ethna_Controller::getDefaultActionPath($action_name, $fallback)</dd>
<dt>アクションクラス名</dt>
<dd>Ethna_Controller::getDefaultActionClass($action_name, $fallback)</dd>
<dt>アクションフォームが定義されたファイルのパス名</dt>
<dd>Ethna_Controller::getDefaultFormPath($action_name, $fallback)</dd>
<dt>アクションフォーム名</dt>
<dd>Ethna_Controller::getDefaultFormClass($action_name, $fallback)</dd>
</dl>

Ethna\_Controllerでは、パス名は(アクションクラス/アクションフォーム共通で):

    $default_path = preg_replace('/_(.)/e', "'/' . strtoupper('\$1')",
    ucfirst($action_name)) . '.php';

つまり"foo\_bar\_hoge" -> "Foo/Bar/Hoge.php"となり、アクションクラス名は

    $postfix = preg_replace('/_(.)/e', "strtoupper('\$1')", ucfirst($action_name));
    ...
    $r = sprintf("%s_Action_%s", $this->getAppId(), $postfix);

となります(アクションフォームは、上記"\_Action\_"の部分が"\_Form\_"になります)。好みに応じて適宜オーバーライドしてください(それほどお勧めはしません)。

例えば、"foo\_bar\_hoge"というアクションに対応するファイル名を"foo\_bar\_hoge.php"にして、アクションクラス名を"foo\_bar\_hoge\_action"、アクションフォーム名を"foo\_bar\_hoge\_form"としたい場合は、以下のアプリケーションのコントローラに以下のような定義を追加します。

Sample\_Controller.php:

    /**
     * アクションに対応するアクションパス名が省略された場合のデフォルトパス名を返す
     *
     * @access public
     * @param string $action_name action名
     * @param bool $fallback クライアント種別によるfallback on/off
     * @return string アクションクラスが定義されるスクリプトのパス名
     */
    function getDefaultActionPath($action_name, $fallback = true)
    {
        return $action_name . ".php";
    }

    /**
     * アクションに対応するフォームパス名が省略された場合のデフォルトパス名を返す
     *
     * @access public
     * @param string $action_name action名
     * @param bool $fallback クライアント種別によるfallback on/off
     * @return string アクションフォームが定義されるスクリプトのパス名
     */
    function getDefaultFormPath($action_name, $fallback = true)
    {
        return $this->getDefaultActionPath($action_name, $fallback);
    }

    /**
     * アクションに対応するアクションクラス名が省略された場合のデフォルトクラス名を返す
     *
     * @access public
     * @param string $action_name アクション名
     * @param bool $fallback クライアント種別によるfallback on/off
     * @return string アクションクラス名
     */
    function getDefaultActionClass($action_name, $fallback = true)
    {
        return $action_name . "_action";
    }

    /**
     * アクションに対応するアクションフォーム名が省略された場合のデフォルトクラス名を返す
     *
     * @access public
     * @param string $action_name アクション名
     * @param bool $fallback クライアント種別によるfallback on/off
     * @return string アクションフォーム名
     */
    function getDefaultFormClass($action_name, $fallback = true)
    {
        return $action_name . "_form";
    }

なお2番目の引数$fallbackは、現在アクティブなクライアントタイプ(PCブラウザ、i-mode、SOAP、etc...)に応じてデフォルト値を変更した場合等に使用しますが、とりあえず無視して頂いてOKです。


* * *
\*1 [アクション定義を省略する](ethna-document-dev_guide-action-omit.html "ethna-document-dev\_guide-action-omit (1240d)")を参照  

