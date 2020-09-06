PHP-NetBox
==========

The NetBox PHP module utilizes the existing API with REST calls to retrieve, update, and manipulate
Network addresses. The available API calls can be referenced in the [NetBox docs](https://netbox.wikimedia.org/api/docs/).

# Installation
Just add the NetBox class to your project.

# Usage:

```
$netBox = new Netbox($host, $token);
$prefix = $netBox->ipam_get_prefixes();
