!
function(a) {
	a(function() {
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			var b = document.createElement("style");
			b.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}")), document.querySelector("head").appendChild(b)
		} {
			var c = a(window),
				d = a(document.body);
			a(".navbar").outerHeight(!0) + 10
		}
		d.scrollspy({
			target: ".js-docs-sidebar"
		}), c.on("load", function() {
			d.scrollspy("refresh")
		}), a(".js-docs-container [href=#]").click(function(a) {
			a.preventDefault()
		}), setTimeout(function() {
			var b = a(".js-docs-sidebar");
			b.affix({
				offset: {
					top: function() {
						var c = b.offset().top,
							d = parseInt(b.children(0).css("margin-top"), 10),
							e = a(".js-docs-nav").height();
						return this.top = c - e - d
					},
					bottom: function() {
						return this.bottom = a(".js-docs-footer").outerHeight(!0)
					}
				}
			})
		}, 100), setTimeout(function() {
			a(".js-top").affix()
		}, 100), a(".tooltip-demo").tooltip({
			selector: "[data-toggle=tooltip]",
			container: "body"
		}), a(".tooltip-test").tooltip(), a(".popover-test").popover(), a(".js-docs-navbar").tooltip({
			selector: "a[data-toggle=tooltip]",
			container: ".js-docs-navbar .nav"
		}), a("[data-toggle=popover]").popover(), a("#loading-example-btn").click(function() {
			var b = a(this);
			b.button("loading"), setTimeout(function() {
				b.button("reset")
			}, 3e3)
		})
	})
}(jQuery);