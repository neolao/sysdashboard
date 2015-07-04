#!/usr/bin/env sysdashboard-node
"use strict";

var _interopRequireDefault = require("babel-runtime/helpers/interop-require-default")["default"];

var _solfegejs = require("solfegejs");

var _solfegejs2 = _interopRequireDefault(_solfegejs);

var _solfegejsCli = require("solfegejs-cli");

var _solfegejsCli2 = _interopRequireDefault(_solfegejsCli);

var _Sysdashboard = require("./Sysdashboard");

var _Sysdashboard2 = _interopRequireDefault(_Sysdashboard);

// Initialize the application
var application = new _solfegejs2["default"].kernel.Application(__dirname);

// Add the external bundles
application.addBundle("console", new _solfegejsCli2["default"].Console());

// Add the internal bundle
application.addBundle("sysdashboard", new _Sysdashboard2["default"]());

// Start the application
application.start();