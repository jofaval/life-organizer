import dotenv from "dotenv";
import express from "express";
import path from "path";

// initialize configuration
dotenv.config();

const ssl = process.env.SERVER_SSL; // the ssl protocol
const port = process.env.SERVER_PORT; // default port to listen
const domain = process.env.SERVER_DOMAIN; // the server domain

const app = express();

// define a route handler for the default home page
app.get( "/", ( req, res ) => {
    res.send( "Hello world!" );
} );

// start the Express server
app.listen( port, () => {
    console.log( `server started at ${ssl}://${domain}:${ port }` );
} );