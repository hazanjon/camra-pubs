#WhatPub.com

This is a great website created by CAMRA and lets you search for local pubs that serve real ale and cider.

Passing an incorrect param to the SearchPubs endpoint along with a high limit seems to return the entire list of pubs. However going above the results returned a 500 error, I finally narrowed the max limit to 33282 and using this I generated the SearchPubs.json which seems to contain the entire database. Using this method doesnt seem vaible long term.

Curl to get results
```
curl 'http://whatpub.com/api/1/SearchPubs' -H 'Origin: http://whatpub.com' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Host: whatpub.com' -H 'Accept-Language: en-GB,en-US;q=0.8,en;q=0.6' -H 'User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36' -H 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' -H 'Accept: application/json, text/javascript, */*; q=0.01' -H 'Referer: http://whatpub.com/' -H 'X-Requested-With: XMLHttpRequest' -H 'Connection: keep-alive' -H 'DNT: 1' --data 'test=S&Limit=33282' --compressed > SearchPubs.json
```

I suspect the best way to use the API in the long term is to generate a list of Counties from the dump and use those to sync down the data in smaller chunks.


#API Endpoints

##http://whatpub.com/api/1/SearchPhotos

PubID: 

Seems to return images of the pub

##http://whatpub.com/api/1/SearchPubs

###Params
Name: searchs name i.e. White

County: County code i.e. NIRE

Location: Not a Param

Query: Not a Param

Search: Not a Param

Limit: 10000 //Max seems to be 33282 any value over this causes a 500 error on the server

Passing an invalid param returns all results

###Example 
Requests using the WPRequest object on the site
```
WPRequest.SearchPubs(
	{
		data:{
			test: "S",
			Limit: 33282
		},
		success: function(res){console.log(res)},
		error: function(res){console.log('error',res)}
	}
);

WPRequest.SearchPubs(
	{
		data:{
			Name: "White",
			Limit: 500
		},
		success: function(res){console.log(res)},
		error: function(res){console.log('error',res)}
	}
);

WPRequest.SearchPubs(
	{
		data:{
			County: "WWCER",
			Limit: 500
		},
		success: function(res){console.log(res)},
		error: function(res){console.log('error',res)}
	}
);
```

##http://whatpub.com/api/1/GetPubDetails

Get a specific pubs details