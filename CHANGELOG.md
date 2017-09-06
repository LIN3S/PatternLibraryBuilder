# CHANGELOG

This changelog references the relevant changes done between versions.

To get the diff for a specific change, go to https://github.com/LIN3S/PatternLibraryBuilder/commit/XXX where XXX is the change hash 
To get the diff between two versions, go to https://github.com/LIN3S/PatternLibraryBuilder/compare/v0.1.0...v0.2.0

* 0.2.0
    * [BC break] Renderers. Changed configuration yml structure to adapt to new renderer (#12).
    
      To upgrade check renderers documentation.
    
    * [BC break] Configuration yml changed. Moved title and description into theme, simplified adding custom styles and
      allowed adding custom js and css files.
      
      Check new configuration reference to upgrade. 
      
    * [BC break] partials/stylesheets.html.twig and partials/javascripts.html.twig extension to add custom stylesheets
      or scripts removed.
      
      Use `theme.javascripts` and `theme.stylesheets` configuration values instead.

* 0.1.0
    * Initial release
