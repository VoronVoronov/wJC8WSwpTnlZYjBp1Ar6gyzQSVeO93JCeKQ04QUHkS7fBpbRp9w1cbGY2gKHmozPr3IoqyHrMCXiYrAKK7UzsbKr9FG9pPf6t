<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="robots" content="noindex,nofollow" />
        <style>
            html{color:#000;background:#FFF;}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}q:before,q:after{content:'';}abbr,acronym{border:0;font-variant:normal;}sup{vertical-align:text-top;}sub{vertical-align:text-bottom;}input,textarea,select{font-family:inherit;font-size:inherit;font-weight:inherit;}input,textarea,select{*font-size:100%;}legend{color:#000;}
            html { background: #eee; padding: 10px }
            img { border: 0; }
            #sf-resetcontent { width:970px; margin:0 auto; }
                        .sf-reset { font: 11px Verdana, Arial, sans-serif; color: #333 }
            .sf-reset .clear { clear:both; height:0; font-size:0; line-height:0; }
            .sf-reset .clear_fix:after { display:block; height:0; clear:both; visibility:hidden; }
            .sf-reset .clear_fix { display:inline-block; }
            .sf-reset * html .clear_fix { height:1%; }
            .sf-reset .clear_fix { display:block; }
            .sf-reset, .sf-reset .block { margin: auto }
            .sf-reset abbr { border-bottom: 1px dotted #000; cursor: help; }
            .sf-reset p { font-size:14px; line-height:20px; color:#868686; padding-bottom:20px }
            .sf-reset strong { font-weight:bold; }
            .sf-reset a { color:#6c6159; cursor: default; }
            .sf-reset a img { border:none; }
            .sf-reset a:hover { text-decoration:underline; }
            .sf-reset em { font-style:italic; }
            .sf-reset h1, .sf-reset h2 { font: 20px Georgia, "Times New Roman", Times, serif }
            .sf-reset .exception_message { margin-left: 0em; display: block; }
            .sf-reset .traces li { font-size:12px; padding: 2px 4px; list-style-type:decimal; margin-left:20px; }
            .sf-reset .block { background-color:#FFFFFF; padding: 20px 28px; margin-bottom:20px;
                -webkit-border-bottom-right-radius: 16px;
                -webkit-border-bottom-left-radius: 16px;
                -moz-border-radius-bottomright: 16px;
                -moz-border-radius-bottomleft: 16px;
                border-bottom-right-radius: 16px;
                border-bottom-left-radius: 16px;
                border-bottom:1px solid #ccc;
                border-right:1px solid #ccc;
                border-left:1px solid #ccc;
                font-size:12px;
            }
            .sf-reset .block_exception { background-color:#ddd; color: #333; padding:20px;
                -webkit-border-top-left-radius: 16px;
                -webkit-border-top-right-radius: 16px;
                -moz-border-radius-topleft: 16px;
                -moz-border-radius-topright: 16px;
                border-top-left-radius: 16px;
                border-top-right-radius: 16px;
                border-top:1px solid #ccc;
                border-right:1px solid #ccc;
                border-left:1px solid #ccc;
                overflow: hidden;
                word-wrap: break-word;
            }
            .sf-reset a { background:none; color:#868686; text-decoration:none; }
            .sf-reset a:hover { background:none; color:#313131; text-decoration:underline; }
            .sf-reset h1 { background-color:#FFFFFF; padding: 15px 28px; margin-bottom: 20px;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                border: 1px solid #ccc;
            }
        </style>
        <link type="text/css" rel="stylesheet" href="/assets/debug/shCore.css" />
        <link type="text/css" rel="stylesheet" href="/assets/debug/shThemeDefault.css" />
        <script type="text/javascript" src="/assets/debug/shCore.js"></script>
        <script type="text/javascript">SyntaxHighlighter.all();</script>
        <script type="text/javascript" src="/assets/debug/shBrushPhp.js"></script>
    </head>
    <body>
        <div id="sf-resetcontent" class="sf-reset">
            <h1><?=$this->description[$this->code]?>.</h1>
            <h2 class="block_exception clear_fix">
                <span class="exception_message"><?=$this->message?></span>
            </h2>
            <div class="block">
                В файле <a title="<?=$this->file?> строка <?=$this->line?>" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;"><?=basename($this->file)?> строка <?=$this->line?></a>
                <pre class="brush: php; highlight: [<?=$this->line-1?>]; first-line: <?=$this->line-4?>;">
                    <?=file($this->file)[$this->line-4]?>
                    <?=file($this->file)[$this->line-3]?>
                    <?=file($this->file)[$this->line-2]?>
                    <?=file($this->file)[$this->line-1]?>
                    <?=file($this->file)[$this->line]?>
                    <?=file($this->file)[$this->line+1]?>
                    <?=file($this->file)[$this->line+2]?>
                    <?=file($this->file)[$this->line+3]?>
                </pre>
            </div>
        </div>
    </body>
</html>