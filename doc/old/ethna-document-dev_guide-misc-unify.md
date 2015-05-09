# スクリプトを1ファイルに統合する

## スクリプトを1ファイルに統合する [](ethna-document-dev_guide-misc-unify.html#deafe16c "deafe16c")

Ethnaもそうですが、ライブラリが大きくなってくるとファイル数も増えてきて、ウェブサーバへのリクエストごとにそれらのファイルが全てinclude/requireされるわけですから、特にnfs上にファイルを置いている場合はファイルシステムへの負荷もばかにならなくなってきます。

そんな場合は、binディレクトリにあるunify\_script.phpを利用してスクリプトを1つのファイルに統合することで(多少のパフォーマンス改善と)ファイルシステムへの負荷低減を行うことが出来ます(Ethna-0.1.2以降)。

使いかたは以下の通りです。

    $ php /usr/local/lib/php/Ethna/bin/unify_script.php [roo_dir] [filter]

root\_dirには統合したいファイルが置かれたディレクトリを指定します。unify\_script.phpは指定されたディレクトリ以下にある全てのファイルを統合しようと試みますので、引数filterに正規表現を使用して対象ファイルを限定してください。

例えばEthnaの全てのスクリプトを1ファイルに統合する場合は以下のようになります。

    $ cd /usr/local/lib/php/Ethna
    $ php bin/unify_script.php . '/Ethna.*php/' > ethna-all-classes.php

あとは

    include_once('Ethna/Ethna.php');

となっているところを

    include_once('Ethna/ethna-all-classes.php');

とすればOKです。

なお、スクリプトを統合しても実行速度はそれほど変わりませんので、ファイルシステムへの負荷が気になる方のみにおすすめします。それ以外の方はわざわざこの手間をかける必要は無いかと思います(パフォーマンス改善ならAPCを入れたほうが良いです)。

