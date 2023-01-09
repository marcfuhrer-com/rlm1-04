## About Interactive Room Map Display

It's a simple REST API based service, which displays views from publishers submitted over the rest api.
The service is composed of the service, the REST API and the subscriber software.

## Roles

There exist multiple roles:
- Service owner: self explanatory
- Service admin: administrating the service via console via plesk
- Publisher: submitting publisher data over REST API
- Subscriber: showing published data via URL
- User: consumers of published data

## Service Owner

Not much to talk about - own's it

## Service Admin

#### Administrating

Administrates the service via following selfmade commands and other artisan commands coming from laravel itself or any third party plugin.
- create:acl             Creates an ACL entry for a user
- create:building        Create a building
- create:floor           Create a floor for a building
- create:role            Create a new role
- create:user            Create a new user
- delete:acl             Deletes an ACL entry
- delete:building        Deletes a building
- delete:floor           Delete an existing floor
- delete:publisherdata   Deletes publisher_data
- delete:role            Delete a role
- delete:user            Delete user
- delete:userrole        Delete a role of an user
- update:acl             Update an existing ACL entry
- update:user            Update an existing user

The commands themselves should be self explanatory at usage.

#### Logging

As the service admin, you can access the log files either via db access in logs-table, or via 
/storage/logs/xxx.log where daily logs will be written.

For easy log-viewing, go on https://service.p1-irm.bfh-web-labs.ch/log-viewer

#### Backup

As the service admin, you can also access the daily backups. You will find them here /storage/app/backup

#### Tests

As the service admin, you can easily check all features functionality via simply running all tests (php artisan test)

#### Usage data

To have access to usage information, simply go to https://service.p1-irm.bfh-web-labs.ch/usage

## Publisher

Uses REST API and gets his documentation here: https://service.p1-irm.bfh-web-labs.ch/api/<version>/...

Obviously depending on version, like this: https://service.p1-irm.bfh-web-labs.ch/api/v1/...

The service REST API is openly accessible here: https://api-doc.p1-irm.bfh-web-labs.ch

The try-it out function can be found here: https://active-api-doc.p1-irm.bfh-web-labs.ch

To have access to usage information, publishers simply can go to https://service.p1-irm.bfh-web-labs.ch/usage

## Subscriber

Subscribers can access the published data over https://service.p1-irm.bfh-web-labs.ch/.

The static subscriber content is available over https://service.p1-irm.bfh-web-labs.ch/publisher/<id1>.
Combining is possible like this https://service.p1-irm.bfh-web-labs.ch/publisher/<id1>+<id2>+<id3> with param ?duration=<value>
for screentime duration till next content will be displayed

## User

Consume and be happy
