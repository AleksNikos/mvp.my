var smartgrid = require('smart-grid');

/* It's principal settings in smart grid project */
var settings = {
    outputStyle: 'less', /* less || sass || sass || styl */
    columns: 12, /* number of grid columns */
    offset: '10px', /* gutter width px || % || rem */
    mobileFirst: false, /* mobileFirst ? 'min-width' : 'max-width' */
    container: {
        maxWidth: '1280px', /* max-width оn very large screen */
        fields: '30px' /* side fields */
    },
    breakPoints: {
        lg: {
            width: '1200px', /* -> @media (max-width: 1200px) */
        },
        md: {
            width: '992px'
        },
        sm: {
            width: '768px',
             /* set fields only if you want to change container.fields */
        },
        xs: {
            width: '560px'
        },
        sxs: {
            width: '380px'
        }
    }
};

smartgrid('app/less', settings);