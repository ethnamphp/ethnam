# Extlib

by sotarok

### extlib/ [](ethna-document-ideas-extlib.html#fa58f491 "fa58f491")

Extlib 以下には現状

- extlib/
  - Plugin/

のみ設置可能で，これを Ethna\_Plugin が利用できるようになっている．これを，

- extlib/
  - Plugin/
  - Action/
  - View/
  - Template/

に拡張し，ClassFactory からそれらを読み込むことができるような仕組みを作成する．

これによりサードパーティ製の Action/View/Template を利用することが可能となり，一連の動作を行うアプリケーションのプラグイン（と呼ぶのかは謎だが）の配布・再利用を可能にする．

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
