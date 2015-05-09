# ビュースクリプトのスケルトンを生成する
  - スケルトンファイルを変更する 

## ビュースクリプトのスケルトンを生成する [](ethna-document-dev_guide-forward-skelton.html#iec9db32 "iec9db32")

[遷移先定義を省略する](ethna-document-dev_guide-forward-omit.html "ethna-document-dev\_guide-forward-omit (1240d)")にて記述したとおり、一定のルールでビュースクリプトのファイル名やビュークラス名が決まるのでしたら、遷移先を追加するたびに毎回スクリプトを1から記述するのは面倒です\*1。

そんなときには、ethnaコマンドのadd-viewオプションを利用して、スケルトンファイルを生成すると楽です。

例えば、"some\_view\_name"というビューを追加したい場合は、

$ ethna add-view some\_view\_name

とするだけです。すると

    generating view script for [some_view_name]...
    view script(s) successfully created [/tmp/sample/app/view
    /Some/View/Name.php]

というメッセージが表示されてビュースクリプトのスケルトンが生成されます。

### スケルトンファイルを変更する [](ethna-document-dev_guide-forward-skelton.html#r33f5da5 "r33f5da5")

実際にはアプリケーション毎にある程度「スケルトンの元になるファイル」を変更したくなると思います。例えば、継承するクラスをEthna\_ViewClassではなく、(Ethna\_ViewClassを継承した)アプリケーション固有のビュークラスにしたい、といったケースです。

この場合は、プロジェクトスケルトン生成後にskelディレクトリに生成されているはずのskel.view.phpを変更することで、生成されるファイルを任意に変更することが出来ます。


* * *
\*1他のスクリプトからコピー&ペースト、という方法もありますがあんまりカッコよくないし  

