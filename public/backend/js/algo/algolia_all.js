
    var client = algoliasearch('R9MGH6O5KT', 'b31a10a64c0d1b641e9419ed5220e551');

    var product = client.initIndex('products');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)

autocomplete(
  '#aa-search-input-all',
  {
    debug: true,
    templates: {
      dropdownMenu:
      '<div class="row">'+
        '<div class="aa-dataset-doctor col-md-4"></div>' +
        '<div class="aa-dataset-caregiver col-md-3"></div>'+'<div class="aa-dataset-clinic col-md-5"></div>'+'</div>'+'<div class="row">'+
        '<div class="aa-dataset-topic col-md-4"></div>' +
        '<div class="aa-dataset-tips col-md-3"></div>'+'<div class="aa-dataset-product col-md-5"></div>'+'</div>',
    },
  },
  [

     {
      source: autocomplete.sources.hits(product, {hitsPerPage: 5}),
      displayKey: 'name',
      name: 'product',
      templates: {
      header: '<div class="aa-suggestions-category text-dark row pl-4 mt-3" ><h4 style="border-bottom:2px solid #a01088" class="float-left"><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>Goodkart Product</h4></div>',
        suggestion: function (suggestion) {
                    const markup = `<p>Ashiq good boy!</p>`;
                    return markup;
        },
          empty: '<div class="aa-empty mt-3"><i class="fa fa-frown-o mr-2" aria-hidden="true"></i>No matching Product</div>',
      },
    },
  ]
);
