(function(a){var t=function(a){var t=typeof a;return"object"===t&&!!a},n=function(a,n){return t(a)?n?a.x:a.y:a},e=function(a){for(var t=[],n=a.length,e=0;e<n;e++)t.push(a[e]);return t},r=function(a){a.originalData=a.datasets.map(function(a){return e(a.data)})},i=function(a,t,e){var r=a.datasets.map(function(a){if(!a._meta)return!0;for(var t in a._meta)return!a._meta[t].hidden}),i=0;a&&a.datasets&&a.datasets[0]&&a.datasets[0].data&&(i=a.datasets[0].data.length);var o=Array.apply(null,new Array(i)).map(function(e,i){return a.datasets.reduce(function(a,e,o){var c=e.stack;return a[c]||(a[c]=0),a[c]+=n(e.data[i],t)*r[o],a},{})});a.calculatedData=a.datasets.map(function(a,r){return a.data.map(function(r,i){var s=o[i][a.stack],u=n(r,t);return u&&s?c(u/s,e):0})})},o=function(a){var t=1;if(!a.hasOwnProperty("precision"))return t;if(!a.precision)return t;var n=Math.floor(a.precision);return isNaN(n)?t:n<0||n>16?t:n},c=function(a,t){var n=Math.pow(10,t);return Math.round(100*a*n)/n},s=function(a){return function(t,e){var r=t.datasetIndex,i=t.index,o=e.datasets[r].label||"",c=e.originalData[r][i],s=e.calculatedData[r][i];return""+o+": "+s+"% ("+n(c,a)+")"}},u=function(a,t){a&&a.forEach(function(a,n){t[n].data=a})},f=function(a){return"horizontalBar"===a.config.type},d={id:"stacked100",beforeInit:function(a,t){if(t.enable){var n=a.options.scales.xAxes,e=a.options.scales.yAxes,r="bar"===a.config.type||"line"===a.config.type;[n,e].forEach(function(a){a.forEach(function(a){a.stacked=!0})}),(r?e:n).forEach(function(a){a.ticks.min||(a.ticks.min=0),a.ticks.max||(a.ticks.max=100)}),t.hasOwnProperty("replaceTooltipLabel")&&!t.replaceTooltipLabel||(a.options.tooltips.callbacks.label=s(f(a)))}},beforeDatasetsUpdate:function(a,t){if(t.enable){r(a.data);var n=o(t);i(a.data,f(a),n),u(a.data.calculatedData,a.data.datasets)}},afterDatasetsUpdate:function(a,t){t.enable&&u(a.data.originalData,a.data.datasets)}};a.pluginService.register(d)}).call(this,Chart);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImNoYXJ0anMtcGx1Z2luLXN0YWNrZWQxMDAuanMiXSwibmFtZXMiOlsiQ2hhcnQiLCJpc09iamVjdCIsIm9iaiIsInR5cGUiLCJkYXRhVmFsdWUiLCJkYXRhUG9pbnQiLCJpc0hvcml6b250YWwiLCJ4IiwieSIsImNsb25lQXJyYXkiLCJzcmNBcnkiLCJkc3RBcnkiLCJsZW5ndGgiLCJpIiwicHVzaCIsInNldE9yaWdpbmFsRGF0YSIsImRhdGEiLCJvcmlnaW5hbERhdGEiLCJkYXRhc2V0cyIsIm1hcCIsImRhdGFzZXQiLCJjYWxjdWxhdGVSYXRlIiwicHJlY2lzaW9uIiwidmlzaWJsZXMiLCJfbWV0YSIsImhpZGRlbiIsImRhdGFzZXREYXRhTGVuZ3RoIiwidG90YWxzIiwiQXJyYXkiLCJhcHBseSIsImVsIiwicmVkdWNlIiwic3VtIiwiaiIsImtleSIsInN0YWNrIiwiY2FsY3VsYXRlZERhdGEiLCJ2YWwiLCJ0b3RhbCIsImR2Iiwicm91bmQiLCJnZXRQcmVjaXNpb24iLCJwbHVnaW5PcHRpb25zIiwiZGVmYXVsdFByZWNpc2lvbiIsImhhc093blByb3BlcnR5Iiwib3B0aW9uc1ByZWNpc2lvbiIsIk1hdGgiLCJmbG9vciIsImlzTmFOIiwidmFsdWUiLCJtdWx0aXBsaWNhdG9yIiwicG93IiwidG9vbHRpcExhYmVsIiwidG9vbHRpcEl0ZW0iLCJkYXRhc2V0SW5kZXgiLCJpbmRleCIsImRhdGFzZXRMYWJlbCIsImxhYmVsIiwib3JpZ2luYWxWYWx1ZSIsInJhdGVWYWx1ZSIsInJlZmxlY3REYXRhIiwic3JjRGF0YSIsImZvckVhY2giLCJpc0hvcml6b250YWxDaGFydCIsImNoYXJ0SW5zdGFuY2UiLCJjb25maWciLCJTdGFja2VkMTAwUGx1Z2luIiwiaWQiLCJiZWZvcmVJbml0IiwiZW5hYmxlIiwieEF4ZXMiLCJvcHRpb25zIiwic2NhbGVzIiwieUF4ZXMiLCJpc1ZlcnRpY2FsIiwiYXhlcyIsImhhc2giLCJzdGFja2VkIiwidGlja3MiLCJtaW4iLCJtYXgiLCJyZXBsYWNlVG9vbHRpcExhYmVsIiwidG9vbHRpcHMiLCJjYWxsYmFja3MiLCJiZWZvcmVEYXRhc2V0c1VwZGF0ZSIsImFmdGVyRGF0YXNldHNVcGRhdGUiLCJwbHVnaW5TZXJ2aWNlIiwicmVnaXN0ZXIiLCJjYWxsIiwidGhpcyJdLCJtYXBwaW5ncyI6IkNBQUMsU0FBU0EsR0FDUixHQUFJQyxHQUFXLFNBQVNDLEdBQ3RCLEdBQUlDLFNBQWNELEVBQ2xCLE9BQWdCLFdBQVRDLEtBQXVCRCxHQUc1QkUsRUFBWSxTQUFTQyxFQUFXQyxHQUNsQyxNQUFJTCxHQUFTSSxHQUNKQyxFQUFlRCxFQUFVRSxFQUFJRixFQUFVRyxFQUd6Q0gsR0FHTEksRUFBYSxTQUFTQyxHQUl4QixJQUFLLEdBSERDLE1BQ0FDLEVBQVNGLEVBQU9FLE9BRVhDLEVBQUksRUFBR0EsRUFBSUQsRUFBUUMsSUFDMUJGLEVBQU9HLEtBQUtKLEVBQU9HLEdBRXJCLE9BQU9GLElBR0xJLEVBQWtCLFNBQVNDLEdBQzdCQSxFQUFLQyxhQUFlRCxFQUFLRSxTQUFTQyxJQUFJLFNBQVNDLEdBQzdDLE1BQU9YLEdBQVdXLEVBQVFKLFNBSzFCSyxFQUFnQixTQUFTTCxFQUFNVixFQUFjZ0IsR0FDL0MsR0FBSUMsR0FBV1AsRUFBS0UsU0FBU0MsSUFBSSxTQUFTQyxHQUN4QyxJQUFLQSxFQUFRSSxNQUFPLE9BQU8sQ0FFM0IsS0FBSyxHQUFJWCxLQUFLTyxHQUFRSSxNQUNwQixPQUFRSixFQUFRSSxNQUFNWCxHQUFHWSxTQUl6QkMsRUFBb0IsQ0FDcEJWLElBQVFBLEVBQUtFLFVBQVlGLEVBQUtFLFNBQVMsSUFBTUYsRUFBS0UsU0FBUyxHQUFHRixPQUNoRVUsRUFBb0JWLEVBQUtFLFNBQVMsR0FBR0YsS0FBS0osT0FFNUMsSUFBSWUsR0FBU0MsTUFBTUMsTUFBTSxLQUFNLEdBQUlELE9BQU1GLElBQW9CUCxJQUFJLFNBQVNXLEVBQUlqQixHQUM1RSxNQUFPRyxHQUFLRSxTQUFTYSxPQUFPLFNBQVNDLEVBQUtaLEVBQVNhLEdBQ2pELEdB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RixjQUFjQyxTQUFTckIsS0FDN0JzQixLQUFLQyxLQUFNekYiLCJmaWxlIjoiY2hhcnRqcy1wbHVnaW4tc3RhY2tlZDEwMC5qcyIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbihDaGFydCkge1xuICB2YXIgaXNPYmplY3QgPSBmdW5jdGlvbihvYmopIHtcbiAgICB2YXIgdHlwZSA9IHR5cGVvZiBvYmo7XG4gICAgcmV0dXJuIHR5cGUgPT09ICdvYmplY3QnICYmICEhb2JqO1xuICB9XG5cbiAgdmFyIGRhdGFWYWx1ZSA9IGZ1bmN0aW9uKGRhdGFQb2ludCwgaXNIb3Jpem9udGFsKSB7XG4gICAgaWYgKGlzT2JqZWN0KGRhdGFQb2ludCkpIHtcbiAgICAgIHJldHVybiBpc0hvcml6b250YWwgPyBkYXRhUG9pbnQueCA6IGRhdGFQb2ludC55O1xuICAgIH1cblxuICAgIHJldHVybiBkYXRhUG9pbnQ7XG4gIH1cblxuICB2YXIgY2xvbmVBcnJheSA9IGZ1bmN0aW9uKHNyY0FyeSkge1xuICAgIHZhciBkc3RBcnkgPSBbXTtcbiAgICB2YXIgbGVuZ3RoID0gc3JjQXJ5Lmxlbmd0aDtcblxuICAgIGZvciAodmFyIGkgPSAwOyBpIDwgbGVuZ3RoOyBpKyspIHtcbiAgICAgIGRzdEFyeS5wdXNoKHNyY0FyeVtpXSk7XG4gICAgfVxuICAgIHJldHVybiBkc3RBcnk7XG4gIH07XG5cbiAgdmFyIHNldE9yaWdpbmFsRGF0YSA9IGZ1bmN0aW9uKGRhdGEpIHtcbiAgICBkYXRhLm9yaWdpbmFsRGF0YSA9IGRhdGEuZGF0YXNldHMubWFwKGZ1bmN0aW9uKGRhdGFzZXQpIHtcbiAgICAgIHJldHVybiBjbG9uZUFycmF5KGRhdGFzZXQuZGF0YSk7XG4gICAgfSk7XG4gIH07XG5cbiAgLy8gc2V0IGNhbGN1bGF0ZWQgcmF0ZSAoeHglKSB0byBkYXRhLmNhbGN1bGF0ZWREYXRhXG4gIHZhciBjYWxjdWxhdGVSYXRlID0gZnVuY3Rpb24oZGF0YSwgaXNIb3Jpem9udGFsLCBwcmVjaXNpb24pIHtcbiAgICB2YXIgdmlzaWJsZXMgPSBkYXRhLmRhdGFzZXRzLm1hcChmdW5jdGlvbihkYXRhc2V0KSB7XG4gICAgICBpZiAoIWRhdGFzZXQuX21ldGEpIHJldHVybiB0cnVlO1xuXG4gICAgICBmb3IgKHZhciBpIGluIGRhdGFzZXQuX21ldGEpIHtcbiAgICAgICAgcmV0dXJuICFkYXRhc2V0Ll9tZXRhW2ldLmhpZGRlbjtcbiAgICAgIH1cbiAgICB9KTtcbiAgICBcbiAgICB2YXIgZGF0YXNldERhdGFMZW5ndGggPSAwO1xuICAgIGlmIChkYXRhICYmIGRhdGEuZGF0YXNldHMgJiYgZGF0YS5kYXRhc2V0c1swXSAmJiBkYXRhLmRhdGFzZXRzWzBdLmRhdGEpIHtcbiAgICAgIGRhdGFzZXREYXRhTGVuZ3RoID0gZGF0YS5kYXRhc2V0c1swXS5kYXRhLmxlbmd0aDtcbiAgICB9XG4gICAgdmFyIHRvdGFscyA9IEFycmF5LmFwcGx5KG51bGwsIG5ldyBBcnJheShkYXRhc2V0RGF0YUxlbmd0aCkpLm1hcChmdW5jdGlvbihlbCwgaSkge1xuICAgICAgcmV0dXJuIGRhdGEuZGF0YXNldHMucmVkdWNlKGZ1bmN0aW9uKHN1bSwgZGF0YXNldCwgaikge1xuICAgICAgICB2YXIga2V5ID0gZGF0YXNldC5zdGFjaztcbiAgICAgICAgaWYgKCFzdW1ba2V5XSkgc3VtW2tleV0gPSAwO1xuICAgICAgICBzdW1ba2V5XSArPSBkYXRhVmFsdWUoZGF0YXNldC5kYXRhW2ldLCBpc0hvcml6b250YWwpICogdmlzaWJsZXNbal07XG5cbiAgICAgICAgcmV0dXJuIHN1bTtcbiAgICAgIH0sIHt9KTtcbiAgICB9KTtcblxuICAgIGRhdGEuY2FsY3VsYXRlZERhdGEgPSBkYXRhLmRhdGFzZXRzLm1hcChmdW5jdGlvbihkYXRhc2V0LCBpKSB7XG4gICAgICByZXR1cm4gZGF0YXNldC5kYXRhLm1hcChmdW5jdGlvbih2YWwsIGkpIHtcbiAgICAgICAgdmFyIHRvdGFsID0gdG90YWxzW2ldW2RhdGFzZXQuc3RhY2tdO1xuICAgICAgICB2YXIgZHYgPSBkYXRhVmFsdWUodmFsLCBpc0hvcml6b250YWwpO1xuICAgICAgICByZXR1cm4gZHYgJiYgdG90YWwgPyByb3VuZChkdiAvIHRvdGFsLCBwcmVjaXNpb24pIDogMDtcbiAgICAgIH0pO1xuICAgIH0pO1xuICB9O1xuXG4gIHZhciBnZXRQcmVjaXNpb24gPSBmdW5jdGlvbihwbHVnaW5PcHRpb25zKSB7XG4gICAgLy8gcmV0dXJuIHRoZSAodmFsaWRhdGVkKSBjb25maWd1cmVkIHByZWNpc2lvbiBmcm9tIHBsdWdpbk9wdGlvbnMgb3IgZGVmYXVsdCAxXG4gICAgdmFyIGRlZmF1bHRQcmVjaXNpb24gPSAxO1xuICAgIGlmICghcGx1Z2luT3B0aW9ucy5oYXNPd25Qcm9wZXJ0eShcInByZWNpc2lvblwiKSkgcmV0dXJuIGRlZmF1bHRQcmVjaXNpb247XG4gICAgaWYgKCFwbHVnaW5PcHRpb25zLnByZWNpc2lvbikgcmV0dXJuIGRlZmF1bHRQcmVjaXNpb247XG4gICAgdmFyIG9wdGlvbnNQcmVjaXNpb24gPSBNYXRoLmZsb29yKHBsdWdpbk9wdGlvbnMucHJlY2lzaW9uKTtcbiAgICBpZiAoaXNOYU4ob3B0aW9uc1ByZWNpc2lvbikpIHJldHVybiBkZWZhdWx0UHJlY2lzaW9uO1xuICAgIGlmIChvcHRpb25zUHJlY2lzaW9uIDwgMCB8fCBvcHRpb25zUHJlY2lzaW9uID4gMTYpIHJldHVybiBkZWZhdWx0UHJlY2lzaW9uOyBcbiAgICByZXR1cm4gb3B0aW9uc1ByZWNpc2lvbjtcbiAgfTtcblxuICB2YXIgcm91bmQgPSBmdW5jdGlvbih2YWx1ZSwgcHJlY2lzaW9uKSB7XG4gICAgdmFyIG11bHRpcGxpY2F0b3IgPSBNYXRoLnBvdygxMCwgcHJlY2lzaW9uKTtcbiAgICByZXR1cm4gTWF0aC5yb3VuZCh2YWx1ZSAqIDEwMCAqIG11bHRpcGxpY2F0b3IpIC8gbXVsdGlwbGljYXRvcjtcbiAgfTtcblxuICB2YXIgdG9vbHRpcExhYmVsID0gZnVuY3Rpb24oaXNIb3Jpem9udGFsKSB7XG4gICAgcmV0dXJuIGZ1bmN0aW9uKHRvb2x0aXBJdGVtLCBkYXRhKSB7XG4gICAgICB2YXIgZGF0YXNldEluZGV4ID0gdG9vbHRpcEl0ZW0uZGF0YXNldEluZGV4O1xuICAgICAgdmFyIGluZGV4ID0gdG9vbHRpcEl0ZW0uaW5kZXg7XG4gICAgICB2YXIgZGF0YXNldExhYmVsID0gZGF0YS5kYXRhc2V0c1tkYXRhc2V0SW5kZXhdLmxhYmVsIHx8IFwiXCI7XG4gICAgICB2YXIgb3JpZ2luYWxWYWx1ZSA9IGRhdGEub3JpZ2luYWxEYXRhW2RhdGFzZXRJbmRleF1baW5kZXhdO1xuICAgICAgdmFyIHJhdGVWYWx1ZSA9IGRhdGEuY2FsY3VsYXRlZERhdGFbZGF0YXNldEluZGV4XVtpbmRleF07XG5cbiAgICAgIHJldHVybiBcIlwiICsgZGF0YXNldExhYmVsICsgXCI6IFwiICsgcmF0ZVZhbHVlICsgXCIlIChcIiArIGRhdGFWYWx1ZShvcmlnaW5hbFZhbHVlLCBpc0hvcml6b250YWwpICsgXCIpXCI7XG4gICAgfVxuICB9O1xuXG4gIHZhciByZWZsZWN0RGF0YSA9IGZ1bmN0aW9uKHNyY0RhdGEsIGRhdGFzZXRzKSB7XG4gICAgaWYgKCFzcmNEYXRhKSByZXR1cm47XG5cbiAgICBzcmNEYXRhLmZvckVhY2goZnVuY3Rpb24oZGF0YSwgaSkge1xuICAgICAgZGF0YXNldHNbaV0uZGF0YSA9IGRhdGE7XG4gICAgfSk7XG4gIH07XG5cbiAgdmFyIGlzSG9yaXpvbnRhbENoYXJ0ID0gZnVuY3Rpb24oY2hhcnRJbnN0YW5jZSkge1xuICAgIHJldHVybiBjaGFydEluc3RhbmNlLmNvbmZpZy50eXBlID09PSBcImhvcml6b250YWxCYXJcIjtcbiAgfVxuXG4gIHZhciBTdGFja2VkMTAwUGx1Z2luID0ge1xuICAgIGlkOiBcInN0YWNrZWQxMDBcIixcblxuICAgIGJlZm9yZUluaXQ6IGZ1bmN0aW9uKGNoYXJ0SW5zdGFuY2UsIHBsdWdpbk9wdGlvbnMpIHtcbiAgICAgIGlmICghcGx1Z2luT3B0aW9ucy5lbmFibGUpIHJldHVybjtcblxuICAgICAgdmFyIHhBeGVzID0gY2hhcnRJbnN0YW5jZS5vcHRpb25zLnNjYWxlcy54QXhlcztcbiAgICAgIHZhciB5QXhlcyA9IGNoYXJ0SW5zdGFuY2Uub3B0aW9ucy5zY2FsZXMueUF4ZXM7XG4gICAgICB2YXIgaXNWZXJ0aWNhbCA9IGNoYXJ0SW5zdGFuY2UuY29uZmlnLnR5cGUgPT09IFwiYmFyXCIgfHwgY2hhcnRJbnN0YW5jZS5jb25maWcudHlwZSA9PT0gXCJsaW5lXCI7XG5cbiAgICAgIFt4QXhlcywgeUF4ZXNdLmZvckVhY2goZnVuY3Rpb24oYXhlcykge1xuICAgICAgICBheGVzLmZvckVhY2goZnVuY3Rpb24oaGFzaCkge1xuICAgICAgICAgIGhhc2guc3RhY2tlZCA9IHRydWU7XG4gICAgICAgIH0pO1xuICAgICAgfSk7XG4gICAgICAoaXNWZXJ0aWNhbCA/IHlBeGVzIDogeEF4ZXMpLmZvckVhY2goZnVuY3Rpb24oaGFzaCkge1xuICAgICAgICBpZiAoIWhhc2gudGlja3MubWluKSBoYXNoLnRpY2tzLm1pbiA9IDA7XG4gICAgICAgIGlmICghaGFzaC50aWNrcy5tYXgpIGhhc2gudGlja3MubWF4ID0gMTAwO1xuICAgICAgfSk7XG5cbiAgICAgIC8vIFJlcGxhY2UgdG9vbHRpcHNcbiAgICAgIGlmIChwbHVnaW5PcHRpb25zLmhhc093blByb3BlcnR5KFwicmVwbGFjZVRvb2x0aXBMYWJlbFwiKSAmJiAhcGx1Z2luT3B0aW9ucy5yZXBsYWNlVG9vbHRpcExhYmVsKSByZXR1cm47XG4gICAgICBjaGFydEluc3RhbmNlLm9wdGlvbnMudG9vbHRpcHMuY2FsbGJhY2tzLmxhYmVsID0gdG9vbHRpcExhYmVsKGlzSG9yaXpvbnRhbENoYXJ0KGNoYXJ0SW5zdGFuY2UpKTtcbiAgICB9LFxuXG4gICAgYmVmb3JlRGF0YXNldHNVcGRhdGU6IGZ1bmN0aW9uKGNoYXJ0SW5zdGFuY2UsIHBsdWdpbk9wdGlvbnMpIHtcbiAgICAgIGlmICghcGx1Z2luT3B0aW9ucy5lbmFibGUpIHJldHVybjtcblxuICAgICAgc2V0T3JpZ2luYWxEYXRhKGNoYXJ0SW5zdGFuY2UuZGF0YSk7XG4gICAgICB2YXIgcHJlY2lzaW9uID0gZ2V0UHJlY2lzaW9uKHBsdWdpbk9wdGlvbnMpO1xuICAgICAgY2FsY3VsYXRlUmF0ZShjaGFydEluc3RhbmNlLmRhdGEsIGlzSG9yaXpvbnRhbENoYXJ0KGNoYXJ0SW5zdGFuY2UpLCBwcmVjaXNpb24pO1xuICAgICAgcmVmbGVjdERhdGEoY2hhcnRJbnN0YW5jZS5kYXRhLmNhbGN1bGF0ZWREYXRhLCBjaGFydEluc3RhbmNlLmRhdGEuZGF0YXNldHMpO1xuICAgIH0sXG5cbiAgICBhZnRlckRhdGFzZXRzVXBkYXRlOiBmdW5jdGlvbihjaGFydEluc3RhbmNlLCBwbHVnaW5PcHRpb25zKSB7XG4gICAgICBpZiAoIXBsdWdpbk9wdGlvbnMuZW5hYmxlKSByZXR1cm47XG5cbiAgICAgIHJlZmxlY3REYXRhKGNoYXJ0SW5zdGFuY2UuZGF0YS5vcmlnaW5hbERhdGEsIGNoYXJ0SW5zdGFuY2UuZGF0YS5kYXRhc2V0cyk7XG4gICAgfVxuICB9O1xuXG4gIENoYXJ0LnBsdWdpblNlcnZpY2UucmVnaXN0ZXIoU3RhY2tlZDEwMFBsdWdpbik7XG59LmNhbGwodGhpcywgQ2hhcnQpKTtcbiJdfQ==
