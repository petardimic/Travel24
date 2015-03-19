// scrollTo fix
if (!window.Effect) var Effect = {};

Effect.ScrollTo = function(element) {
  var options = arguments[1] || { },
  scrollOffsets = document.viewport.getScrollOffsets(),
  elementOffsets = $(element).cumulativeOffset();

  if (options.offset) elementOffsets[1] += options.offset;

  return new Effect.Tween(null,
    scrollOffsets.top,
    elementOffsets[1],
    options,
    function(p){ scrollTo(scrollOffsets.left, p.round()) }
  );
};

var Projects = {
  links: [
    { name: 'Lightview', href: 'http://www.nickstakenburg.com/projects/lightview', 
	  hook: { tip: 'topRight', target: 'bottomLeft' }
	},
	{ name: 'Prototip 2', href: 'http://www.nickstakenburg.com/projects/prototip2', 
	  hook: { tip: 'topRight', target: 'bottomLeft' }
	},
	{ name: 'Pushup', href: 'http://www.pushuptheweb.com', 
	  hook: { tip: 'topRight', target: 'bottomLeft' }
	},
    { name: 'Starbox', href: 'http://www.nickstakenburg.com/projects/starbox', 
	  hook: { tip: 'topRight', target: 'bottomLeft' }
	}
  ],
  
  getTipContent: function(name) {
    if (!($('ideas') || $('projects'))) return;
	
	var wrapper = new Element('div', { className: 'ideaTip' });
	
	this.links.each(function(l,i) {
	  wrapper.insert(new Element('div', { className: 'ideaLink'})
		.insert(new Element('a', {
			className: 'idea' + l.name + (i + 1 == this.links.length ? ' last' : ''),
			href: l.href
			})
			.update(l.name)
		)
	  );
    }.bind(this));

	return wrapper;
  },
  
  createIdeas: function(name) {
	var content = this.getTipContent(name),
	ideas = $('ideas'),
	projects = $('projects'),
	fakeEl = { hook: { tip: 'topRight', target: 'bottomLeft' } }
	
	if (Prototip.Version.startsWith('2')) {
		if (ideas) {
		  var hook = (this.links.find(function(l) { return l.name.toUpperCase() == name.toUpperCase(); }) || fakeEl).hook;
		  new Tip('ideas', content, Object.extend({
			style: 'creamy',
			className: 'creamy creamyIdeas',
			hook: hook,
			stem: hook.tip,
			hideOn: false,
			hideAfter: 1.5,
			width: 'auto',
			offset: { x: 6, y: 0 }
		  }, arguments[1] || {}));
		}
		else if(projects) {
		  new Tip(projects, content, Object.extend({
			hook: { target: 'bottomLeft', tip: 'topLeft' },
			stem: 'topLeft',
			offset: { x: 0, y: 2 },
			hideOn: false,
			hideAfter: 1.5
		  }, arguments[1] || {}));
		}
	}
    else {
		if (ideas) {
		  var hook = this.links.find(function(l) { return l.name.toUpperCase() == name.toUpperCase(); }).hook;
		  new Tip('ideas', content, Object.extend({
			className: 'ideaTip',
			effect: 'appear',
			hook: hook,
			hideOn: false,
			hideAfter: 1.5
		  }, arguments[1] || {}));
		}
		else if(projects) {
		  new Tip(projects, content, Object.extend({
			className: 'ideaTip',
			effect: 'appear',
			hook: { target: 'bottomLeft', tip: 'topLeft' },
			offset: { x: 0, y: 2 },
			hideOn: false,
			hideAfter: 1.5
		  }, arguments[1] || {}));
		}
	}
  }	
}

document.observe('dom:loaded', function() {
  var project = $(document.body).className != 'projectLicense' ? $(document.body).className.substr(7).toLowerCase() : null;
  if (!project) return;
  
  if ($('inlineDemo')) {
	  $('inlineDemo').select('a.submit').invoke('observe', 'click', function(event) {
		event.stop();
		location.href = 'http://www.nickstakenburg.com/projects/download/?project=' + project;
	  });
  }
  
});