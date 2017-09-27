
var editor = document.getElementById("editor");
var a = CodeMirror.fromTextArea(editor, {
    mode: "text/x-c++src",
	lineNumbers: true,
	indentUnit: 2

});
a.setSize("600px","710px");



/*
var mode_cpp = CodeMirror.getMode({indentUnit: 2}, "text/x-c++src");
  function MTCPP(name) { editor.mode(name, mode_cpp, Array.prototype.slice.call(arguments, 1)); }

  MTCPP("cpp14_literal",
    "[number 10'000];",
    "[number 0b10'000];",
    "[number 0x10'000];",
    "[string '100000'];");

  MTCPP("ctor_dtor",
     "[def Foo::Foo]() {}",
     "[def Foo::~Foo]() {}");
})();
*/
/*
var editor = document.getElementById("editor");
var a = CodeMirror.fromTextArea(editor, {
    mode: "text/x-c++src",
	lineNumbers: true,
	indentUnit: 2

});
var mode_cpp = CodeMirror.getMode({indentUnit: 2}, "text/x-c++src");
  function MTCPP(name) { a.mode(name, mode_cpp, Array.prototype.slice.call(arguments, 1)); }

  MTCPP("cpp14_literal",
    "[number 10'000];",
    "[number 0b10'000];",
    "[number 0x10'000];",
    "[string '100000'];");

  MTCPP("ctor_dtor",
     "[def Foo::Foo]() {}",
     "[def Foo::~Foo]() {}");
*/