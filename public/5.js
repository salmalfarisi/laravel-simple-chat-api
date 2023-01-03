(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/content/account/registration.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/content/account/registration.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _elements_form_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../elements/form.vue */ "./resources/js/components/elements/form.vue");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      data: {
        success: false,
        message: '',
        token: '',
        id: '',
        email: '',
        name: '',
        password: '',
        repeat_password: ''
      }
    };
  },
  mounted: function mounted() {
    this.checklogin();
  },
  methods: {
    regis: function regis() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                document.getElementById('error_name').innerHTML = '';
                document.getElementById('error_email').innerHTML = '';
                document.getElementById('error_password').innerHTML = '';
                document.getElementById('error_repeat_password').innerHTML = '';
                _context.next = 6;
                return _this.axios.post("/api/account/register", _this.data).then(function (response) {
                  _this.success = response.data.success;
                  _this.data = response.data.data;

                  if (_this.success == true) {
                    alert('Akun berhasil dibuat');

                    _this.$router.push({
                      name: 'Main'
                    });

                    return false;
                  } else {
                    console.log(_this.message);
                  }
                })["catch"](function (error) {
                  var message = error.response;
                  var geterror = message.data.data;

                  for (var _i = 0, _Object$keys = Object.keys(geterror); _i < _Object$keys.length; _i++) {
                    var key = _Object$keys[_i];
                    var setvar = 'error_' + key;
                    var sethtml = 'geterror.' + key;
                    document.getElementById(setvar).innerHTML = eval(sethtml);
                  }
                });

              case 6:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    checklogin: function checklogin() {// belum tahu mau ngapain disini

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    }
  },
  components: {
    'Forms': _elements_form_vue__WEBPACK_IMPORTED_MODULE_1__["default"]
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/content/account/registration.vue?vue&type=template&id=8c598308&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/content/account/registration.vue?vue&type=template&id=8c598308& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "content-header pt-5 mt-3" }, [
    _c("div", { staticClass: "container" }, [
      _c("div", { staticClass: "h1" }, [
        _vm._v("\n                Registrasi Akun Baru\n            "),
      ]),
      _vm._v(" "),
      _c(
        "form",
        {
          on: {
            submit: function ($event) {
              $event.preventDefault()
              return _vm.regis.apply(null, arguments)
            },
          },
        },
        [
          _c("Forms", {
            attrs: {
              type: "email",
              labels: "Email",
              setid: "email",
              setattribute: "",
            },
            model: {
              value: _vm.data.email,
              callback: function ($$v) {
                _vm.$set(_vm.data, "email", $$v)
              },
              expression: "data.email",
            },
          }),
          _vm._v(" "),
          _c("Forms", {
            attrs: {
              type: "text",
              labels: "Nama",
              setid: "name",
              setattribute: "",
            },
            model: {
              value: _vm.data.name,
              callback: function ($$v) {
                _vm.$set(_vm.data, "name", $$v)
              },
              expression: "data.name",
            },
          }),
          _vm._v(" "),
          _c("Forms", {
            attrs: {
              type: "password",
              labels: "Password",
              setid: "password",
              setattribute: "",
            },
            model: {
              value: _vm.data.password,
              callback: function ($$v) {
                _vm.$set(_vm.data, "password", $$v)
              },
              expression: "data.password",
            },
          }),
          _vm._v(" "),
          _c("Forms", {
            attrs: {
              type: "password",
              labels: "Repeat Password",
              setid: "repeat_password",
              setattribute: "",
            },
            model: {
              value: _vm.data.repeat_password,
              callback: function ($$v) {
                _vm.$set(_vm.data, "repeat_password", $$v)
              },
              expression: "data.repeat_password",
            },
          }),
          _vm._v(" "),
          _c("div", { staticClass: "mt-4 d-flex justify-content-between" }, [
            _c(
              "div",
              [
                _c(
                  "router-link",
                  {
                    staticClass: "btn btn-danger float-left",
                    attrs: { to: { name: "Main" } },
                  },
                  [_vm._v("Kembali")]
                ),
              ],
              1
            ),
            _vm._v(" "),
            _vm._m(0),
          ]),
        ],
        1
      ),
    ]),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c(
        "button",
        {
          staticClass: "btn btn-primary float-right",
          attrs: { type: "submit", value: "save" },
        },
        [_vm._v("Daftar")]
      ),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/content/account/registration.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/content/account/registration.vue ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _registration_vue_vue_type_template_id_8c598308___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./registration.vue?vue&type=template&id=8c598308& */ "./resources/js/components/content/account/registration.vue?vue&type=template&id=8c598308&");
/* harmony import */ var _registration_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./registration.vue?vue&type=script&lang=js& */ "./resources/js/components/content/account/registration.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _registration_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _registration_vue_vue_type_template_id_8c598308___WEBPACK_IMPORTED_MODULE_0__["render"],
  _registration_vue_vue_type_template_id_8c598308___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/content/account/registration.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/content/account/registration.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/content/account/registration.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_registration_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./registration.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/content/account/registration.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_registration_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/content/account/registration.vue?vue&type=template&id=8c598308&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/content/account/registration.vue?vue&type=template&id=8c598308& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_registration_vue_vue_type_template_id_8c598308___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./registration.vue?vue&type=template&id=8c598308& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/content/account/registration.vue?vue&type=template&id=8c598308&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_registration_vue_vue_type_template_id_8c598308___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_registration_vue_vue_type_template_id_8c598308___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);