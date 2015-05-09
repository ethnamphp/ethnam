# フォーム値の自動検証を行う(複合チェック編)

参考 [[Ethna-users:00012] ](http://ml.ethna.jp/pipermail/users/2005-March/000012.html)

## フォーム値の自動検証を行う(複合チェック編) [](ethna-document-dev_guide-form-complexvalidate.html#t2f2b2f0 "t2f2b2f0")

「条件付きでrequired」というような場合は、アクションフォームのprepare()でvalidate()を実行する「前」で、フォーム値の判別によって

    if (...) {
      $this->af->form['bill']['required'] = true;
    }

みたいなことをしています。

