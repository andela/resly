/*
   Bloodhound is the typeahead.js suggestion engine. It offers advanced
   functionalities such as prefetching, intelligent caching, fast lookups,
   and backfilling with remote data.
 */
var restaurants = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
    url: '/restaurants/search?query=%QUERY',
    wildcard: '%QUERY',
  }
});

$(document).ready(function() {
    $('#query.typehead').typeahead({
      hint: true,
      highlight: true,
      minLength: 2
    },
    {
      name: 'restaurants',
      display: 'name',
      source: restaurants,
    });
    $('#query.typehead').bind('typeahead:select', function(ev, suggestion) {
      window.location.href = "/search?query=" + suggestion.name;
    });
});
