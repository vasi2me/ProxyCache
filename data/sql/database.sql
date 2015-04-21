BEGIN TRANSACTION;
----
-- Table structure for uris
----

CREATE TABLE 'uris' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'schema' TEXT, 'http_method' TEXT,'response_id' INTEGER,'request_id' INTEGER, 'usemock' BOOLEAN, 'timestamp' DATETIME DEFAULT CURRENT_TIMESTAMP, 'path' TEXT NOT NULL, 'query' TEXT);


----
-- Table structure for responses
----
CREATE TABLE 'responses' ('id' INTEGER PRIMARY KEY NOT NULL, 'code' INTEGER,'message' TEXT,'body' BLOB,'headers' TEXT,'cookies' TEXT);

----
-- Table structure for config
----
CREATE TABLE 'config' ('id' INTEGER PRIMARY KEY NOT NULL, 'name' TEXT NOT NULL, 'value' TEXT NOT NULL);

----
-- Data dump for config, a total of 6 rows
----
INSERT INTO "config" ("id","name","value") VALUES ('1','Host','http://services.qa13codemacys.fds.com');
INSERT INTO "config" ("id","name","value") VALUES ('2','Mock','TRUE');
INSERT INTO "config" ("id","name","value") VALUES ('3','OriginHeader','x-macys-webservice-client-id: testclient_1.0_kweu3w323a');
INSERT INTO "config" ("id","name","value") VALUES ('4','OriginHeader','x-macys-customer-id: testclient_1.0_kweu3w323a');
INSERT INTO "config" ("id","name","value") VALUES ('5','OriginHeader','Accept: Application/json');
INSERT INTO "config" ("id","name","value") VALUES ('6','ProxyHeaderCheck','True');
COMMIT;