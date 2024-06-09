const configs = {
	"urlbase":"http://135.181.43.100:3400/api/",
	"headers":{headers:{Authorization: 'Bearer ' + localStorage.getItem('bumbeiros_jwt')}},
	"headersform":{Authorization: "Bearer " + localStorage.getItem('bumbeiros_jwt'),'Content-Type': `multipart/form-data`},
}

export { configs }