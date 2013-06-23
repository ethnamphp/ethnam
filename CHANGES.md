# 変更点一覧

## Ethna 2.6.0beta4からの変更点

* PHP5.4に対応しました。(主な変更はhtmlspecialcharsの第三引数です。)
* extlibを廃止しました。
* インストール方法が変わりました。(pear installはできなくなりました。)
* 主なプロパティ・メソッドでprivate,protected だったものをpublicにしました。これはEthna2.5との後方互換を確保するためです。
* Puginの命名規則を2.5に近い状態に戻しました。プラグインのクラス名で2.5と同じようにAppIDが使えます。(例：Project_Plugin_Cachemanager_Memcache)
* ActionFormの配列バリデーション, {form ..}, {form_input ..},などの仕様を古い(2.3.5あたり?)状態に戻しました。( see commit cc6d63eae1a615b3868e309ff53fd77414bbd4c7 )
* Ethna_Plugin_Abstractを廃止しました。これによりプラグインの基底クラスはなくなりました。
* メールアドレスのバリデーションで、@の左側の?を許可するようにしました。
* Ethna_ActionError#AddError()した際のログ出力をLOG_NOTICE -> LOG_INFO に変更しました。
* Ethna_ActionFormで、nullを''空文字列に変換してしまうバグを修正しました。(commit de1442bd55397834a7b6228c3c0ae694849237db)
* bin/ethna.batを廃止しました。今後、Windowsは推奨環境から外れます。
* Smartyがテンプレートを出力する際に、メモリ使用量をHTTPヘッダ(`X-MemoryUsage`)で出力するようにしました。
* ADODBのログ出力処理をオーバーライドできるようにしました。(`ethna_adodb_logger`というグローバル関数内で処理がべた書きされていたのを改善)
* `adodb/adodb.inc.php`をEthna側でrequireしなくなりました。(アプリケーション側でrequire_onceする必要があります。)

## 2.7 からの変更点

* AppObject, AppSQL, AppSearchObjectを廃止しました。(commit e871a1addafae0314bd62dfc8a3e209359ac4a2f)
