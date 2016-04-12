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
      window.location.href = "/search?query="+suggestion.name
    });
    
});
