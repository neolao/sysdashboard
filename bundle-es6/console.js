#!/usr/bin/env sysdashboard-node

import solfege from "solfegejs";
import solfegeCli from "solfegejs-cli";
import Sysdashboard from "./Sysdashboard";

// Initialize the application
let application = new solfege.kernel.Application(__dirname);

// Add the external bundles
application.addBundle("console", new solfegeCli.Console);

// Add the internal bundle
application.addBundle('sysdashboard', new Sysdashboard);

// Start the application
application.start();

