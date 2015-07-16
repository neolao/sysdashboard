#!/usr/bin/env sysdashboard-node
"use strict";

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var _solfegejs = require("solfegejs");

var _solfegejs2 = _interopRequireDefault(_solfegejs);

var _solfegejsCli = require("solfegejs-cli");

var _solfegejsCli2 = _interopRequireDefault(_solfegejsCli);

var _solfegejsServer = require("solfegejs-server");

var _solfegejsServer2 = _interopRequireDefault(_solfegejsServer);

var _solfegejsServerStatic = require("solfegejs-server-static");

var _solfegejsServerStatic2 = _interopRequireDefault(_solfegejsServerStatic);

var _Sysdashboard = require("./Sysdashboard");

var _Sysdashboard2 = _interopRequireDefault(_Sysdashboard);

// Initialize the application
var application = new _solfegejs2["default"].kernel.Application(__dirname);

// Add the external bundles
application.addBundle("console", new _solfegejsCli2["default"].Console());
application.addBundle("server", new _solfegejsServer2["default"].HttpServer());
application.addBundle("static", new _solfegejsServerStatic2["default"].Static());

// Add the internal bundle
application.addBundle("sysdashboard", new _Sysdashboard2["default"]());

var configuration = require(__dirname + "/../config/default");
application.overrideConfiguration(configuration);

// Start the application
application.start();