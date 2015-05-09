# テンプレート定義省略時の命名規則を変更する

## テンプレート定義省略時の命名規則を変更する [](ethna-document-dev_guide-forward-template_namingconvention.html#td2b03ef "td2b03ef")

遷移先定義が省略された場合\*1、以下のファイル名が暗黙のうちに決定されます。

- テンプレートが定義されたファイルのパス名

これらの命名規則は、Ethna\_Controllerに定義されている以下のメソッドをオーバーライドすることで変更することが出来ます。

<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>テンプレートが定義されたファイルのパス名</dt>
<dd>Ethna_Controller::getDefaultForwardPath($forward_name)</dd>
</dl>

また，以下のメソッドも変更することを推奨します。

:テンプレートパス名から遷移名を取得する |Ethna\_Controller::forwardPathToName($forward\_path)

※forwardPathToNameは、コードをリバースエンジニアリングしたい場合に使います。

Ethna\_Controllerでは、パス名は

    return str_replace('_', '/', $forward_name) . '.' . $this->ext['tpl'];

つまり"foo\_bar\_hoge" -> "foo/bar/hoge.tpl"となります。 好みに応じて適宜オーバーライドしてください(それほどお勧めはしません)。

例えば、"foo\_bar\_hoge"というビュークラスに対応するファイル名を"foo\_bar\_hoge.tpl"としたい場合は、以下のアプリケーションのコントローラに以下のような定義を追加します。

    /**
     * @access public
     * @param string $forward_name forward名
     * @return string forwardパス名
     */
    function getDefaultForwardPath($forward_name)
    {
        return $forward_name . '.' . $this->ext['tpl'];
    }

そして、forwardPathToNameも変更しておきます。

    /**
     * @access public
     * @param string $forward_path テンプレートパス名
     * @return string 遷移名
     */
    function forwardPathToName($forward_path)
    {
        $forward_name = preg_replace('/^\/+/', '', $forward_path);
        $forward_name = preg_replace(sprintf('/\.%s$/', $this->getExt('tpl')), '', $forward_name);
        return $forward_name;
    }


* * *
\*1 [遷移先定義を省略する](ethna-document-dev_guide-forward-omit.html "ethna-document-dev\_guide-forward-omit (1240d)")を参照  

