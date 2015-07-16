#!/usr/bin/env sysdashboard-node

import solfege from "solfegejs";
import cli from "solfegejs-cli";
import server from "solfegejs-server";
import middlewareStatic from "solfegejs-server-static";
import Sysdashboard from "./Sysdashboard";

// Initialize the application
let application = new solfege.kernel.Application(__dirname);

// Add the external bundles
application.addBundle("console", new cli.Console);
application.addBundle("server", new server.HttpServer);
application.addBundle("static", new middlewareStatic.Static);

// Add the internal bundle
application.addBundle("sysdashboard", new Sysdashboard);

let configuration = require(__dirname + "/../config/default");
application.overrideConfiguration(configuration);

// Start the application
application.start();

