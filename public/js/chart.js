/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/chart.js":
/*!*************************************!*\
  !*** ./resources/js/admin/chart.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function dataChart() {
  var year = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 2019;
  var data = this.value;
  var time = parseInt($(this).data('id'));
  var url = "/admin/chart";
  $.ajax({
    url: url,
    method: "GET",
    data: {
      year: year
    },
    success: function success(response) {
      var objData = {
        type: "column",
        indexLabel: "{y}",
        indexLabelFontStyle: "italic",
        indexLabelBackgroundColor: "LightBlue"
      };
      objData.dataPoints = [{
        label: "Jan",
        y: Number(response['1'])
      }, {
        label: "Feb",
        y: Number(response['2'])
      }, {
        label: "Mar",
        y: Number(response['3'])
      }, {
        label: "Apr",
        y: Number(response['4'])
      }, {
        label: "May",
        y: Number(response['5'])
      }, {
        label: "Jun",
        y: Number(response['6'])
      }, {
        label: "Jul",
        y: Number(response['7'])
      }, {
        label: "Aug",
        y: Number(response['8'])
      }, {
        label: "Sep",
        y: Number(response['9'])
      }, {
        label: "Oct",
        y: Number(response['10'])
      }, {
        label: "Nov",
        y: Number(response['11'])
      }, {
        label: "Dec",
        y: Number(response['12'])
      }];
      var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light1",
        // "light2", "dark1", "dark2"
        animationEnabled: true,
        // change to true
        title: {
          text: "Book statistics created"
        }
      });
      chart.options.data = [];
      chart.options.data.push(objData);
      chart.render();
    }
  });
}

window.onload = function () {
  dataChart();
};

$(document).on('change', '.year', function () {
  var year = $(this).val();
  dataChart(year);
});

/***/ }),

/***/ 2:
/*!*******************************************!*\
  !*** multi ./resources/js/admin/chart.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/quycoi/Desktop/Project/project1-sun/resources/js/admin/chart.js */"./resources/js/admin/chart.js");


/***/ })

/******/ });