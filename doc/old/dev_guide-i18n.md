# プロジェクトの国際化
    注意：このページで記述している機能を使うには、Ethna 2.5.0 以降が必要です。

Ethnaで作ったプロジェクトを複数の言語に対応させる方法は一応2.3系までも存在していました。しかし、切り替えるメッセージのカタログを作るための支援機能がなかったことと、ロケールの定義が曖昧だったことが原因で、楽なものではありませんでした。

Ethna 2.5.0 以降では、これらの欠点を解消するために、メッセージカタログの自動生成機能を実装し、ロケール周りのAPIを整備しました。ここではそれらを使ってEthnaのプロジェクトを国際化したWebアプリにする方法を紹介します。

- プロジェクトの国際化 
  - 基本的な手順 
  - プロジェクトの作成と設定 
  - PHPスクリプト、テンプレートへのメッセージの埋め込み 
  - メッセージカタログの作成 
  - メッセージカタログの種類 
    - iniファイル 
    - gettextのカタログファイル 
    - gettextを使うべき場合 
  - カタログを翻訳する 
    - iniファイルの場合 
    - gettextの場合 
  - プログラム上でのロケール切り替え 
  - 制限事項、TODO 

| 書いた人 | mumumu | 2008-10-08 | 新規作成 |

### 基本的な手順

国際化(i18n) に対応したプロジェクトを作るための手順は以下の通りです。 特に 2. の部分は、メッセージが多ければ多いほど地道な作業になりがちで、後になればなるほど大変です。国際化を意識したプロジェクトを作る場合は、可能であれば早い段階からそれを意識して以下の作業をするとよいでしょう。

1. プロジェクトを作成し、設定する
2. 国際化関数(テンプレートでは修正子)をPHPスクリプトに埋め込む
3. ethna i18n コマンドを実行し、メッセージカタログを自動生成する
4. 自動生成したカタログを翻訳する
5. 必要に応じてPHPスクリプト上でロケールを切り替える

### プロジェクトの作成と設定

プロジェクトを作成し、デフォルトのロケール名\*1を設定します。 文字コードはデフォルトの UTF-8 で作成することを強く推奨します\*2。

    (/tmp ディレクトリに sampleプロジェクトを作成 文字コードはデフォルトのUTF-8)
    ethna add-project -b /tmp sample

デフォルトのロケール名は、Ethna_Controller#_getDefaultLanguage メソッドを以下のようにオーバーライドすることで設定します。詳しくは [言語とエンコーディングの設定](dev_guide-app-setlanguage.md#v4c471ad) を参照して下さい。

/tmp/sample/app/Sample_Controller.php には、デフォルトで以下のように、「ja_JP」が設定されています。

    /**
     * デフォルト状態での使用言語を取得する
     * 外部に出力されるEthnaのエラーメッセージ等のエンコーディングを
     * 切り替えたい場合は、このメソッドをオーバーライドする。
     *
     * @access protected
     */
    function _getDefaultLanguage()
    {
        // ロケール名(e.x ja_JP, en_US 等),
        // システムエンコーディング名,
        // クライアントエンコーディング(= テンプレートのエンコーディング) の配列
        return array('ja_JP', 'UTF-8', 'UTF-8');
    }

### PHPスクリプト、テンプレートへのメッセージの埋め込み

プロジェクト内のPHPスクリプト(テストスクリプトを除く)、テンプレートにメッセージを埋め込みます。PHPスクリプトでは _et 関数を使い、テンプレートには i18n 修正子を埋め込みます。

以下では、i18ntest アクションを作成し、挨拶文を埋め込んでいます。

    ethna add-action i18ntest

    class Sample_Form_I18ntest extends Sample_ActionForm
    {
        var $form = array(
            // form 定義の 以下の要素も、i18nコマンドは抜き出して
            // くれます。なぜ抜き出してくれるかというと、メンバ変数
            // の初期化は _et() や、gettext の _() のような関数の戻
            // り値ではできないからです。
            //
            // 'name', 'required_error',
            // 'type_error', 'min_error',
            // 'max_error', 'regexp_error'
        );
    } 
    
    class Sample_Action_I18ntest extends Sample_ActionClass
    {
       function prepare()
       {
           return null;
       }
    
       function perform()
       {
           // アクション内に国際化メッセージを埋め込む例
           // _et 関数に渡す値は固定文字列でなければなりません
           // そうでないと ethna i18n コマンドが解釈できません
           $this->af->setApp('greetings', _et("hello world"));
           $this->af->setApp('part', _et("bye"));
           return 'i18ntest';
       } 
    }

テンプレートは対応させるロケールの数だけ作成します。以下では、デフォルトの ja_JP(日本語) のものと、ko_KR(韓国語) のものを /tmp/sample/templates/[ja_JP|ko_KR]/i18ntest.tpl に 作成しています。

    ethna add-template i18ntest
    ethna add-template -l ko_KR i18ntest

    {* /tmp/sample/templates/[ja_JP|ko_KR]/i18ntest.tpl *}
    {* PHPスクリプト内での国際化メッセージを埋め込んでもよいし *}
    {* 固定の文字列に i18n 修正子を通してもよい *}
    
    {$app.greetings}<br>
    {$app.part}<br>
    {'foo'|i18n}

### メッセージカタログの作成

プロジェクト内のファイルにメッセージを埋め込んだら、メッセージカタログの作成です。これは、プロジェクトディレクトリに移動して [ethna i18n コマンド](dev_guide-ethna_command.md#vd9b3c8f)を実行するだけです。これは、作成したロケールの数だけ実行する必要があります。

実行すると、/tmp/sample/locale/[ja_JP|ko_KR]/LC_MESSAGES/[ja_JP|ko_KR].ini が生成されます。

    ethna i18n -l ja_JP
    ethna i18n -l ko_KR

ethna i18n コマンドで作成できるカタログは、ethna 組み込みの iniファイルと、国際化用のソフトウェアとして広く知られている [gettext](http://www.gnu.org/software/gettext/) 用の poファイルがあります。デフォルトでは ini ファイルが作成されますが、poファイルを作成するには [-g|--gettext] オプションを指定します。

    ethna i18n -l ja_JP -g
    ethna i18n -l ko_KR -g

実行すると、/tmp/sample/locale/[ja_JP|ko_KR]/LC_MESSAGES/[ja_JP|ko_KR].po が生成されます。

既にファイルがあった場合、iniファイルの場合は、既存の翻訳を引き継いだ上でファイルが上書きされます。gettext の場合は、最新のメッセージを抜き出した（但し翻訳語は空）の新しくファイルが作られます。gettext は、 [msgmerge プログラム](http://www.gnu.org/software/gettext/manual/html_node/msgmerge-Invocation.html#msgmerge-Invocation) を使うことで古い po ファイルと内容をマージすることが出来ます。

ini ファイルと gettext の違いについては、以下で説明します。

### メッセージカタログの種類

#### iniファイル

Ethna のデフォルトのカタログファイルです。gettext が入っていない環境を考慮して、このフォーマットがデフォルトになっています。内容は ini ファイルライクですが、翻訳後のメッセージと元のメッセージは必ず「ダブルクォート」で囲まれている必要があります。また、ファイルの文字コードは必ずUTF-8になります。

内容としては、「"元のメッセージ" = "翻訳語"」 というフォーマットになります。

これまで例として作ってきた sample プロジェクトに ethna i18n コマンドを実行すると、/tmp/sample/locale/ja_JP/LC_MESSAGES/ja_JP.ini は以下のようになります。

    ;
    ; ja_JP.ini
    ;
    ; This file stores Ethna project(Sample) system
    ; message and error message and its translation. This
    ; file's encoding is always UTF-8.
    ;
    ; This file is ini file like format. For example,
    ;
    ; "msgid" = "Translated string."
    ;
    ; msgid and Translated string must be always double quoted.
    ; When you want to include double quote in msgid or Translated
    ; string, you must escape it by backslash character.
    ; Comment line is started by semicolon character.
    ;
    ; DO NOT CHANGE msgid string!!!!
    ;
    
    ; /tmp/sample/app/action/I18ntest.php
    "hello world" = ""
    "bye" = ""
    
    ; /tmp/sample/template/ja_JP/i18ntest.tpl
    "foo" = ""

#### gettextのカタログファイル

gettext 向けのカタログファイルは poファイルと呼ばれるものです。ただ、gettext を実際に使うときはこのファイルで動作するわけではありません。このファイルを翻訳した上でさらに [msgfmt コマンド](http://www.gnu.org/software/gettext/manual/html_node/msgfmt-Invocation.html#msgfmt-Invocation) を実行し、moファイルと呼ばれるバイナリファイルを生成する必要があります。

これまで例として作ってきた sample プロジェクトに ethna i18n -g コマンドを実行すると、/tmp/sample/locale/ja_JP/LC_MESSAGES/ja_JP.po は以下のようになります。

    #
    # ja_JP.po
    # This is message catalog file for Ethna Project(Sample).
    # FIRST AUTHOR <EMAIL@ADDRESS>, YEAR.
    #
    
    msgid ""
    msgstr ""
    "Project-Id-Version: PACKAGE VERSION\n"
    "Report-Msgid-Bugs-To: \n"
    "POT-Creation-Date: 2008-10-10 10:53+0900\n"
    "PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\n"
    "Last-Translator: FULL NAME <EMAIL@ADDRESS>\n"
    "Language-Team: LANGUAGE <LL@li.org>\n"
    "MIME-Version: 1.0\n"
    "Content-Type: text/plain; charset=UTF-8\n"
    "Content-Transfer-Encoding: 8bit\n"
    
    #: /tmp/sample/app/action/I18ntest.php:97
    msgid "hello world"
    msgstr ""
    
    #: /tmp/sample/app/action/I18ntest.php:98
    msgid "bye"
    msgstr ""
     
    #: /tmp/sample/template/ja_JP/i18ntest.tpl
    msgid "foo"
    msgstr ""

#### gettextを使うべき場合

Ethna 組み込みの iniファイル形式は、いわば「なんちゃって」に過ぎません。メッセージを抜き出すことを支援してはくれますが、長期に渡ってメンテナンスするのには向いていません。そうしたツールを実装していないからです。

たとえば、ソースコードを見て古いものと新しいものを比較し、メッセージの状態（翻訳済、曖昧(fuzzy)な状態、未翻訳）に分けるような技は iniファイルではできません。また、複数形のような翻訳形式にも未対応です。gettext では、そうした状態を見た上で翻訳を編集するための便利なツールが既に数多くあります。

おそらく、大きなソースを長期的にメンテナンスするのであれば、gettext が明らかに向いていますし、gettextの利用を強く推奨します。小さなプロジェクトであれば、iniファイルでもよいかもしれません。

では、なぜそんななんちゃってモードを作ったのか？ それは gettext が入っていない環境を考えたことと、小さなプロジェクトなら gettext のような大げさなことをしなくてもいい場合があるだろう、と考えたからです。このモードの必要性についてはきっと多くの議論があることでしょう。是非 [コミュニティのページ](ethna-community.html) をご覧になり、開発者にフィードバックをお願いします。

### カタログを翻訳する

#### iniファイルの場合

ini ファイルの場合は、空文字列「""」の部分に翻訳語を入れていきます。例えば以下のような形になります。これは生成したロケールのiniファイル全てに対して行います。

    ; /tmp/sample/app/action/I18ntest.php
    "hello world" = "こんにちは世界"
    "bye" = "さようなら"
     
    ; /tmp/sample/template/ja_JP/i18ntest.tpl
    "foo" = "ふー"

#### gettextの場合

gettext の場合は、msgstr の部分に翻訳語を入れていく形式です。直接編集しても構わないのですが、翻訳の状態を見た上で便利にpoファイルを編集できる便利なツールが既に数多く存在します。これらを使って、生成したロケールのpoファイル全てに対して翻訳を行って下さい。

- [emacs の po-mode](http://www.gnu.org/software/automake/manual/gettext/PO-Mode.html)
- [poEditor(Windows, \*nix系向け)](http://www.poedit.net/)
- [kbabel (X Window環境用)](http://www.kde.gr.jp/pukiwiki/index.php?KBabel)
- ...などなど

翻訳が終わったら msgfmt コマンドで mo ファイルを生成して下さい。-oオプションの引数として必ず [ロケール名].mo を渡すようにして下さい。 これは作成したロケールの poファイルすべてに対して行います。

    cd /tmp/sample/locale/ja_JP/LC_MESSAGES/
    msgfmt -o ja_JP.mo ja_JP.po

### プログラム上でのロケール切り替え

複数のロケールに対してメッセージカタログを作成したら、あとは必要に応じて、PHPスクリプト内でロケールを切り替えるだけです。

それには、適切な場所で Ethna_Controllerクラスの setLocale メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    $ctl->setLocale('ko_KR');

Ethna_Controller には、アクションが実行される「直前」に呼ばれる _setLanguage というメソッドがあります。これをオーバライドすれば、条件に応じてデフォルトのロケールを上書きすることが出来ます。

    function _setLanguage($locale, $system_encoding = null, $client_encoding = null)
     {
          // ロケールを ko_KR に、クライアントエンコーディングを
          // 'EUC_KR' に変更する   
          $this->locale = 'ko_KR';
          $this->system_encoding = $system_encoding;
          $this->client_encoding = 'EUC_KR';
    
          // ロケールを変更した際は、必ず $i18n のsetLanguageメソッド
          // も呼び出すこと。
          $i18n =& $this->getI18N();
          $i18n->setLanguage($locale, $system_encoding, $client_encoding);
     }

または、言語毎にコントローラーを複数作り、そこの _getDefaultLanguage() メソッドでロケールをそれぞれ設定するというのも手です。以下のように作り、それを www 以下のエントリポイントから呼び出してやります。

    // .snip
    
    /**
     * /tmp/sample/app/Sample_Controller をコピーして作ったもの
     */
    class Sample_ko_KR_Controller extends Ethna_Controller
    {
        // ... snip
    
        function _getDefaultLanguage()
        {
            return array('ko_KR', 'UTF-8', 'UTF-8');
        }
    }

    <?php
    require_once '/tmp/sample/app/Sample_ko_KR_Controller.php';
    
    Sample_ko_KR_Controller::main('Sample_ko_KR_Controller', 'index');
    ?>

gettext を使う場合は、etc/[appid]-ini.php の use_gettext を true にする必要があります。

    $config = array(
        // i18n
        'use_gettext' => true,
    );

### 制限事項、TODO

- 既にサンプルソースのコメントでも述べていますが、_et 関数や i18n 修正子に渡す引数は固定文字列であることを強く推奨します。ethna i18n コマンドはその形式しか解釈できないからです。どうしても動的な(実行時にしか決まらない)値を渡したい場合は、自分でその値を見極めた上でカタログを手動で追加する必要があります。
- [gettextを使うべき場合](dev_guide-i18n.md#l4e0ac9b) でも述べていますが、Ethna は生成したメッセージカタログに対して状態を付加するなどして長期に渡ってメンテナンスするための便利な仕組みを持っていません。gettextの方がそうした点や翻訳のフォーマット（複数形など）の点で多くの機能を備えていますので、そういった要求がある場合はgettextの使用を強く推奨します。
- 現行のEthnaの実装では、メッセージの翻訳(LC_MESSAGES)に対応しているだけで、その他のお金や日時の変換等のAPIは未実装です。それらについては独自に実装するなり、外部ライブラリを使うなりして、Ethna_I18n.php を拡張して頂ければと思います。


* * *
\*1ロケールとは、言語や特定の地域におけるお金、日付などの表記規則の集合のことです。ロケール名とは、ここでは特定の地域の名前くらいの意味で使っています。ロケール名の詳細については、 [gettextのマニュアル](http://www.gnu.org/software/gettext/manual/html_node/Locale-Names.html#Locale-Names) が非常にうまく説明しています。  
\*2複数の言語を同時に表現できる文字コードであればOKなのですが、、UTF-8が現実的な選択肢だと思います  

