# Ethna 2.5.0 から 2.6.0 への移行ガイド
### 後方互換性を失う変更について [](ethna-document-dev_guide-misc-migrate_project250to260.html#g0f19bff "g0f19bff")

#### コンストラクタの変更(\_\_construct) [](ethna-document-dev_guide-misc-migrate_project250to260.html#c89a578a "c89a578a")

Ethna2.6.0からは、クラスのコンストラクタが\_\_constructに統一されました。

あなたが使用しているアプリケーションの中で、例えばparent::Ethna\_ActionClass()などとしている場合は、これをparent::\_\_constructに変更する必要があります。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
