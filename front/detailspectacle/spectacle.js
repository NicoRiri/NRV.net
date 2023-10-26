const queryString = window.location.search;
const params = new URLSearchParams(queryString);
const idValue = params.get("id");
console.log(idValue);