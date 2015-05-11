# 言語とエンコーディングの設定
    注意：このページで記述している機能を使うには、Ethna 2.5.0 以降が必要です。

ここでは、Ethna での言語とエンコーディングの設定、およびそれを切り替える方法について説明します。\*1

- 言語とエンコーディングの設定 
  - Ethna における言語設定の要素とその設定 
    - プロジェクトで使用するロケールの設定と影響範囲 
    - プロジェクトで使用するエンコーディングの設定と影響範囲 
  - ethna コマンドでの言語設定 
    - ethna add-project コマンド 
    - ethna add-view, add-template コマンド 
  - 言語設定を動的に変更する 
    - ロケールの変更 
    - プロジェクトで使用するエンコーディングの変更 
    - Ethna_Controller#_setLanguage メソッドをオーバーライドする 
    - 言語設定の変更は慎重に行うべき 
  - 言語設定を取得する 
    - ロケール名、エンコーディングの設定を一気に取得する 
    - ロケール名を取得する 
    - エンコーディングを取得する 

| 書いた人 | mumumu | 2008-06-30 | 新規作成 |

### Ethna における言語設定の要素とその設定

Ethna では、[appid]_Controller の _getDefaultLanguage メソッドをオーバーライドすることで言語設定を行い、ロケール名とテンプレートのエンコーディング(クライアントエンコーディングと呼びます)を設定します。デフォルトの実装は以下のようになります。

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

このメソッドでは、以下の3つの値を配列として返します。

- 1. ロケール名(デフォルト ja_JP)  
ロケールとは地域の文化、言語等を表す規則です。具体的には ja_JP, en_US のように、[言語コード]_[国名コード] の値を設定します。  
  
- 2. システムエンコーディング（デフォルトUTF-8)  
現状未使用ですが、将来の拡張のために予約されています。基本的には何を設定しても構いませんが、将来の拡張に備えて意味のあるエンコーディングを設定するようにしましょう。  
  
- 3. クライアントエンコーディング（デフォルトUTF-8）  
ブラウザに表示するテンプレートのエンコーディングであり、プロジェクトの内部エンコーディングのことです。[appid]/template ディレクトリ以下に置くテンプレートのエンコーディングを設定します。以下で特に断らずに「エンコーディング」と述べている箇所は、このクライアントエンコーディングのことを指しています。  

#### プロジェクトで使用するロケールの設定と影響範囲

プロジェクトで設定するロケールは、ethnaコマンドの add-project 時に決まります([appid]_Controller の _getDefaultLanguage メソッドでも変更可)。すでに述べたように、何も指定しないとデフォルトのロケールとして ja_JP が仮定されますが、ethna コマンド実行時にそれを変更することも出来ます。

    ethna add-project -l en_US sample

こうすると、デフォルトのロケールは en_US となり、テンプレートディレクトリとして [appid]/template/en_US が作られます。また、Ethnaが出力するエラーメッセージのカタログファイルが以下の場所に作成されます。

    [appid]/locale/en_US/LC_MESSAGES/ethna_sysmsg.ini

つまり、Ethnaのロケール設定/変更 で影響するのは以下の二つです。

- テンプレートのディレクトリ
- Ethnaが吐き出すエラーメッセージカタログのディレクトリ

#### プロジェクトで使用するエンコーディングの設定と影響範囲

ロケールと同様、プロジェクトで使用するエンコーディングは、ethnaコマンドの add-project 時に決まります([appid]_Controller の _getDefaultLanguage メソッドでも変更可)。すでに述べたように、何も指定しないとデフォルトのエンコーディングとして UTF-8 が仮定されますが、ethna コマンド実行時にそれを変更することも出来ます。

    ethna add-project -e utf-8 sample

こうすると、プロジェクトのエンコーディングとして EUC_JP が仮定されます。但し、ここで設定するエンコーディングは、 [PHPの mbstring が認識できるもの](http://www.php.net/manual/en/function.mb-list-encodings.php) を設定して下さい。\*2

つまり、Ethnaのエンコーディング設定/変更 で影響するのは以下の2つです。

- テンプレートのエンコーディング（Ethnaから出力するエラーメッセージも含む)
- Ethna 内部で mbstring が使用する内部エンコーディング(validate, filterの際のエンコーディング等)

### ethna コマンドでの言語設定

ethna コマンドには、ロケールやエンコーディング指定を行えるようになっているコマンドが複数あります。

#### ethna add-project コマンド

add-project コマンドでは、下の通りロケールとエンコーディングを指定できます。これによって、ロケールとプロジェクトのエンコーディングが指定できるようになっています。

    ethna add-project ... [-l|--locale] [-e|--encoding] [Application id]

#### ethna add-view, add-template コマンド

add-view コマンドおよび、add-template コマンドでもロケールとエンコーディングを指定できます。これによって、テンプレートを置くディレクトリと、テンプレートの charset 属性が決まります。指定されたエンコーディングで文字が書き込まれるわけではないことに注意して下さい。

また、add-view コマンドの場合は、-t オプションが指定されない限り、ロケールとエンコーディングのオプションは無視されます。

    ethna add-view -> add new view to project:
       add-view [options...] [view name]
       [options ...] are as follows.
           [-b|--basedir=dir] [-s|--skelfile=file]
           [-w|--with-unittest] [-u|--unittestskel=file]
           [-t|--template] [-l|--locale] [-e|--encoding]
       NOTICE: "-w" and "-u" options are ignored when you specify -t option.
               "-l" and "-e" options are enabled when you specify -t option.

    ethna add-template ... [-l|--locale] [-e|--encoding] [template]

### 言語設定を動的に変更する

Web からのリクエストに応じて、[appid]_Controller の _getDefaultLanguage で行った設定を変えたい場合もあると思います。その方法を以下で説明します。

#### ロケールの変更

Ethna_Controller#setLocale メソッドを使います。ただし、このメソッドを使うとテンプレートのディレクトリや、Ethna が出力するエラーメッセージのカタログディレクトリもそのロケールに変更されますので注意して下さい。

[appid]/locale 指定したロケールファイルがない場合は、デフォルトの英語のシステムメッセージが使われます。また、[appid]/template 以下に指定したロケールのディレクトリがない場合は単にエラーになるでしょう。

    $ctl = Ethna_Controller::getInstance();
    $ctl->setLocale('en_US');

#### プロジェクトで使用するエンコーディングの変更

Ethna_Controller#setClientEncoding メソッドを使います。ただし、このメソッドを使うと Ethna が mbstring で使う内部エンコーディングも変更されるので注意して下さい。つまり、Ethnaが出力するエラーメッセージのエンコーディングも変更されます。

    $ctl = Ethna_Controller::getInstance();
    $ctl->setClientEncoding('utf-8');

#### Ethna_Controller#_setLanguage メソッドをオーバーライドする

言語を変更するためのフックとして Ethna_Controllerクラスに _setLanguage メソッドが用意されています。このメソッドはアクションクラスが呼ばれる直前、かつ Session, Backend, ActionForm が初期化された直後に必ず呼び出されます。ここで、Ethna_Controller のプロパティを書き換えた上で、Ethna_I18n#setLanguage を呼び出してロケールやカタログの中身を再ロードさせるようにします。

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

コントローラーを複数用意し、それぞれに _getDefaultLanguage をオーバライドしてエントリポイントから呼び出してやるという手もあります。

#### 言語設定の変更は慎重に行うべき

既に述べたように、言語設定の変更は、Ethnaが見に行くディレクトリの変更や、内部エンコーディングの変更など、内部の動作をそれなりに変更するものです。

よって上記のAPIを用いるときは、 [影響範囲に関する記述](app-setlanguage.md#q5ae4f6f) を読み、自分が何をしているのかをしっかりと理解した上で慎重に使用するようにして下さい。

### 言語設定を取得する

Ethna_Controller クラスに、_getDefaultLanguage メソッドや、set[Locale|ClientEncoding] メソッドで設定された言語設定を取得するAPIが定義されているので、それを使います。

#### ロケール名、エンコーディングの設定を一気に取得する

Ethna_Controller#getLanguage メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    list($locale, $system_encoding, $client_encoding) = $ctl->getLanguage();

#### ロケール名を取得する

Ethna_Controller#getLocale メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    $locale = $ctl->getLocale();

#### エンコーディングを取得する

Ethna_Controller#getClientEncoding メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    $client_encoding = $ctl->getClientEncoding();


* * *
\*1Ethna 2.5.0 以降では、内部のエンコーディング、およびエラーメッセージが utf-8 決め打ちから、エンコーディングに依存しない方式に変更されました。それに伴う変更について述べています。  
\*2PHP5以降でEthnaを使用した場合、-eオプションで不正なエンコーディングを入力するとエラーにしています。PHP4 では、サポートされるエンコーディングがわからないため、このチェックは行われません。(mb_list_encodings 関数がPHP5以降なため  

