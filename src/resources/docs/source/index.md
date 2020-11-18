---
title: API Reference

language_tabs:
- bash
- php
- javascript
- python

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://core.org/docs/collection.json)

<!-- END_INFO -->

#SchoolCollege


<!-- START_8ea7cf0dea681819c61db0281dfe3889 -->
## Get list

> Example request:

```bash
curl -X GET \
    -G "https://core.org/api/colleges" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"keyword":{"":"recusandae"}}'

```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'https://core.org/api/colleges',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'keyword' => [
                '' => 'recusandae',
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/colleges"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "keyword": {
        "": "recusandae"
    }
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/colleges'
payload = {
    "keyword": {
        "": "recusandae"
    }
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers, json=payload)
response.json()
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/colleges`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `keyword.` | Example: |  optional  | title
    
<!-- END_8ea7cf0dea681819c61db0281dfe3889 -->

<!-- START_779acb2569011489f5639a8f425ae169 -->
## Create

> Example request:

```bash
curl -X POST \
    "https://core.org/api/colleges" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'https://core.org/api/colleges',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/colleges"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/colleges'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()
```



### HTTP Request
`POST api/colleges`


<!-- END_779acb2569011489f5639a8f425ae169 -->

<!-- START_407e918e03db55634e9030656c3bf4d9 -->
## Display

> Example request:

```bash
curl -X GET \
    -G "https://core.org/api/colleges/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'https://core.org/api/colleges/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/colleges/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/colleges/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/colleges/{college}`


<!-- END_407e918e03db55634e9030656c3bf4d9 -->

<!-- START_a004da0837a27f4043208ac4e39a2470 -->
## Update

> Example request:

```bash
curl -X PUT \
    "https://core.org/api/colleges/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'https://core.org/api/colleges/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/colleges/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/colleges/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers)
response.json()
```



### HTTP Request
`PUT api/colleges/{college}`

`PATCH api/colleges/{college}`


<!-- END_a004da0837a27f4043208ac4e39a2470 -->

<!-- START_310414b54582db9989299b75d55f8e8f -->
## Remove

> Example request:

```bash
curl -X DELETE \
    "https://core.org/api/colleges/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'https://core.org/api/colleges/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/colleges/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/colleges/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```



### HTTP Request
`DELETE api/colleges/{college}`


<!-- END_310414b54582db9989299b75d55f8e8f -->

#Product


<!-- START_86e0ac5d4f8ce9853bc22fd08f2a0109 -->
## Get list

> Example request:

```bash
curl -X GET \
    -G "https://core.org/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"keyword":"fugit"}'

```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'https://core.org/api/products',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'keyword' => 'fugit',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "keyword": "fugit"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/products'
payload = {
    "keyword": "fugit"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers, json=payload)
response.json()
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [],
    "first_page_url": "http:\/\/localhost\/api\/products?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost\/api\/products?page=1",
    "next_page_url": null,
    "path": "http:\/\/localhost\/api\/products",
    "per_page": 20,
    "prev_page_url": null,
    "to": null,
    "total": 0
}
```

### HTTP Request
`GET api/products`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `keyword` | Example: |  optional  | title
    
<!-- END_86e0ac5d4f8ce9853bc22fd08f2a0109 -->

<!-- START_05b4383f00fd57c4828a831e7057e920 -->
## Create

> Example request:

```bash
curl -X POST \
    "https://core.org/api/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'https://core.org/api/products',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/products'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()
```



### HTTP Request
`POST api/products`


<!-- END_05b4383f00fd57c4828a831e7057e920 -->

<!-- START_a285e63bc2d1a5b9428ae9aed745c779 -->
## Display

> Example request:

```bash
curl -X GET \
    -G "https://core.org/api/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'https://core.org/api/products/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/products/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```



### HTTP Request
`GET api/products/{product}`


<!-- END_a285e63bc2d1a5b9428ae9aed745c779 -->

<!-- START_b7842ce7893c09eb3c53713f82c2e12d -->
## Update

> Example request:

```bash
curl -X PUT \
    "https://core.org/api/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'https://core.org/api/products/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/products/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers)
response.json()
```



### HTTP Request
`PUT api/products/{product}`

`PATCH api/products/{product}`


<!-- END_b7842ce7893c09eb3c53713f82c2e12d -->

<!-- START_1d809ca5e8b10fa7fdc75d04506a55ea -->
## Remove

> Example request:

```bash
curl -X DELETE \
    "https://core.org/api/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'https://core.org/api/products/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```javascript
const url = new URL(
    "https://core.org/api/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```python
import requests
import json

url = 'https://core.org/api/products/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```



### HTTP Request
`DELETE api/products/{product}`


<!-- END_1d809ca5e8b10fa7fdc75d04506a55ea -->


