#!/usr/bin/env python3
"""
Generate an importable Elementor template JSON for TrackAttack Pro.
Import via: Elementor → Templates → Saved Templates → Import Templates.
Then apply to a page and set that page as the homepage.

Native widgets (Heading / Text Editor / Image) are used for all editable
text and images. HTML widgets are used only for complex sections
(product table, radar charts, contact form, SVG callouts).
"""
import json, re, secrets, html, os

BASE = "http://track.avitheret.com/wp-content/themes/trackattack-pro/assets/images/"
ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
THEME = os.path.join(ROOT, "wp-theme", "trackattack-pro")

# colors
RED   = "#e31837"
ONS   = "#e5e2e1"
ONSV  = "#e6bdbb"
SEC   = "#adc6ff"
OUT   = "#ad8886"
BG    = "#131313"
CLOW  = "#1c1b1b"
CONT  = "#201f1f"
LOWEST= "#0e0e0e"
OUTV  = "#5d3f3e"

def uid():
    return secrets.token_hex(4)[:7]

def section(elements, *, bg_color=BG, bg_image=None, pad=(80,64,80,64),
            border_top=None, content_pos=None, min_h=None, gap="default"):
    s = {
        "background_background": "classic",
        "background_color": bg_color,
        "padding": {"unit":"px","top":str(pad[0]),"right":str(pad[1]),
                    "bottom":str(pad[2]),"left":str(pad[3]),"isLinked":False},
        "layout": "full_width",
        "content_width": {"unit":"px","size":1100},
        "gap": gap,
    }
    if bg_image:
        s.update({
            "background_image": {"url": bg_image, "id": ""},
            "background_position": "center center",
            "background_size": "cover",
            "background_repeat": "no-repeat",
        })
    if border_top:
        s.update({
            "border_border":"solid","border_color":border_top,
            "border_width":{"unit":"px","top":"4","right":"0","bottom":"0","left":"0","isLinked":False},
        })
    if content_pos:
        s["content_position"] = content_pos
    if min_h:
        s["height"] = "min-height"
        s["custom_height"] = {"unit":"px","size":min_h}
    return {"id":uid(),"elType":"section","settings":s,"elements":elements,"isInner":False}

def column(widgets, size=100, *, align=None, valign=None):
    s = {"_column_size": size, "_inline_size": None}
    if align:
        s["align"] = align
    if valign:
        s["content_position"] = valign
    return {"id":uid(),"elType":"column","settings":s,"elements":widgets,"isInner":False}

def heading(text, *, tag="h2", size=48, color=ONS, italic=True, align="left", ff="Anton"):
    s = {
        "title": text,
        "header_size": tag,
        "title_color": color,
        "align": align,
        "typography_typography": "custom",
        "typography_font_family": ff,
        "typography_font_weight": "400",
        "typography_font_size": {"unit":"px","size":size,"sizes":[]},
        "typography_line_height": {"unit":"em","size":1,"sizes":[]},
        "typography_text_transform": "none",
    }
    if italic:
        s["typography_font_style"] = "italic"
    return {"id":uid(),"elType":"widget","widgetType":"heading","settings":s,"elements":[]}

def textw(html_content, *, color=ONSV, size=17, lh=1.7, align="left", ff="Hanken Grotesk"):
    s = {
        "editor": html_content,
        "text_color": color,
        "align": align,
        "typography_typography": "custom",
        "typography_font_family": ff,
        "typography_font_size": {"unit":"px","size":size,"sizes":[]},
        "typography_line_height": {"unit":"em","size":lh,"sizes":[]},
    }
    return {"id":uid(),"elType":"widget","widgetType":"text-editor","settings":s,"elements":[]}

def image(url, *, width=100, align="center", alt=""):
    s = {
        "image": {"url": url, "id": "", "alt": alt, "source": "url"},
        "image_size": "full",
        "align": align,
        "width": {"unit":"%","size":width,"sizes":[]},
    }
    return {"id":uid(),"elType":"widget","widgetType":"image","settings":s,"elements":[]}

def htmlw(content):
    return {"id":uid(),"elType":"widget","widgetType":"html",
            "settings":{"html":content},"elements":[]}

# ── load product table HTML ──
with open(os.path.join(THEME, "inc", "product-table.php")) as f:
    table_php = f.read()
# strip the one PHP echo for the logo src → replace with absolute URL
table_html = re.sub(r"<\?php.*?\?>", BASE + "TAP-Logo@4x.png", table_php, flags=re.S)

# ── build content ──
content = []

# 1. HERO
content.append(section(
    [column([
        heading("Conquer. Every. Drive.", tag="h1", size=72, color=ONS),
        textw('<p style="border-left:4px solid '+RED+';padding-left:24px;'
              'font-family:\'JetBrains Mono\',monospace;font-size:13px;'
              'letter-spacing:.1em;text-transform:uppercase;color:'+ONSV+';">'
              'Ultimate Track Day Weapon</p>'),
    ])],
    bg_image=BASE+"racetrack_camera_03.jpg", bg_color=LOWEST,
    min_h=620, content_pos="bottom", pad=(0,64,80,64),
))

# 2. PRESENTED BY
content.append(section(
    [column([heading("Presented By", tag="h6", size=12, italic=False,
                     align="center", ff="JetBrains Mono", color=SEC)], align="center")],
    bg_color=CONT, pad=(40,64,40,64),
))

# 3. FEATURES  (image | check-list HTML)
feat_items = [
    "<strong>UTQG 200</strong> rated <strong>Extreme Performance Summer</strong> tire",
    "Engineered for <strong>track dominance</strong> and <strong>street performance</strong> with <strong>Hoosier Racing DNA</strong>",
    "Addictive levels of <strong>responsiveness</strong> and <strong>handling</strong>",
    "<strong>Unrivaled grip</strong> derived from motorsports-proven compounds",
    "<strong>Adrenaline fueled acceleration</strong> fused with <strong>dynamic braking</strong>",
]
check = ('<span style="flex-shrink:0;width:22px;height:22px;background:'+RED+';'
         'display:flex;align-items:center;justify-content:center;margin-top:2px;">'
         '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fffaf9" '
         'stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></span>')
feat_html = '<ul style="list-style:none;display:flex;flex-direction:column;gap:20px;margin:0;padding:0;">'
for it in feat_items:
    feat_html += ('<li style="display:flex;gap:14px;font-family:\'Hanken Grotesk\',sans-serif;'
                  'font-size:16px;line-height:1.6;color:'+ONSV+';">'+check+'<div>'+it+'</div></li>')
feat_html += '</ul>'
content.append(section(
    [ column([image(BASE+"Tire-angle-lrg.png", width=90)], size=50),
      column([htmlw(feat_html)], size=50) ],
))

# 4. VIDEO
play = ('<div style="position:relative;z-index:1;display:flex;flex-direction:column;'
        'align-items:center;"><button onclick="window.open(\'#\',\'_blank\')" '
        'style="width:80px;height:80px;background:'+RED+';border:none;cursor:pointer;'
        'display:flex;align-items:center;justify-content:center;box-shadow:0 0 30px rgba(227,24,55,.4);">'
        '<svg width="28" height="28" viewBox="0 0 24 24" fill="#fffaf9" style="margin-left:4px;">'
        '<polygon points="5,3 19,12 5,21"/></svg></button>'
        '<p style="margin-top:16px;font-family:\'JetBrains Mono\',monospace;font-size:12px;'
        'font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#ffb3b1;">Play Video</p></div>'
        '<div style="position:absolute;inset:0;background:rgba(19,19,19,.7);"></div>')
content.append(section(
    [column([htmlw(play)], align="center")],
    bg_image=BASE+"Tire-angle-lrg-web-no-text.jpg", bg_color=LOWEST,
    min_h=480, content_pos="middle", pad=(0,0,0,0), border_top=RED,
))

# 5. TECH CALLOUTS
icons = [
 '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>',
 '<path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="3"/>',
 '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
 '<rect x="3" y="3" width="18" height="18"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>',
 '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>',
]
ctext = [
 "<strong>Extra-wide shoulder ribs</strong> maximize cornering performance",
 "<strong>Featherlight construction</strong> provides peak responsiveness",
 "<strong>H-DNA technology:</strong> 65+ years of Hoosier Racing DNA",
 "<strong>Optimized center rib</strong> for increased braking performance",
 "<strong>Motorsports derived compound</strong>",
]
grid = '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:24px;">'
for ic, tx in zip(icons, ctext):
    grid += ('<div style="text-align:center;padding:24px;border:1px solid '+OUTV+';background:'+CONT+';">'
             '<div style="width:48px;height:48px;background:'+RED+';margin:0 auto 16px;display:flex;'
             'align-items:center;justify-content:center;"><svg width="20" height="20" viewBox="0 0 24 24" '
             'fill="none" stroke="#fffaf9" stroke-width="1.5">'+ic+'</svg></div>'
             '<p style="font-family:\'Hanken Grotesk\',sans-serif;font-size:15px;line-height:1.6;color:'+ONSV+';margin:0;">'+tx+'</p></div>')
grid += '</div>'
content.append(section(
    [column([ image(BASE+"Tire-angle-lrg.png", width=28), htmlw(grid) ])],
    bg_color=CLOW, pad=(80,64,80,64),
))

# 6. GALLERY
content.append(section(
    [column([
        heading("For Drivers", size=48, color=RED),
        textw('<p>...brings track dominance to the street</p>', size=16),
    ])],
    bg_color=BG, pad=(80,64,30,64), border_top=OUTV,
))
content.append(section(
    [ column([image(BASE+"TAP-2000x1000-master8.jpg", width=100, alt="C8 Corvette front")], size=50),
      column([image(BASE+"TAP-2000x1000-master6.jpg", width=100, alt="C8 Corvette rear")], size=50) ],
    bg_color=BG, pad=(0,64,80,64),
))

# 7. ABOUT
content.append(section(
    [column([
        htmlw('<div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(0,0,0,.9),rgba(0,0,0,.55));"></div>'),
        heading("TrackAttack Pro", size=48, color=ONS),
        textw("<p>...masters both street and track. Harnessing Hoosier&#8217;s unparalleled racing DNA, "
              "taking track dominance to the street, the TrackAttack Pro drives highly addictive performance.</p>"),
    ], size=60)],
    bg_image=BASE+"TAP-2000x1000-master6.jpg", bg_color=LOWEST,
    min_h=460, content_pos="middle",
))

# 8. CTA BANNER
content.append(section(
    [column([
        htmlw('<div style="position:absolute;inset:0;background:rgba(19,19,19,.8);"></div>'),
        heading("Revolutionary extreme performance summer tire", size=44, color=ONS, align="center"),
        textw("<p><em>...awakens daily commutes, empowers epic track days &ndash; and ignites legendary journeys in between.</em></p>", align="center"),
    ], align="center")],
    bg_image=BASE+"TAP-2000x1000-master-1.jpg", bg_color=LOWEST,
    min_h=440, content_pos="middle", border_top=RED,
))

# 9. CINEMATIC
cine = ('<div style="position:absolute;inset:0;background:url(\''+BASE+'Tire-angle-lrg-web-no-text.jpg\') center/cover;'
        'opacity:.15;filter:grayscale(100%);"></div>'
        '<style>@keyframes ftf{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}</style>'
        '<div style="position:relative;z-index:1;text-align:center;"><img src="'+BASE+'Tire-angle-lrg.png" '
        'style="max-width:350px;width:80vw;filter:drop-shadow(0 0 60px rgba(227,24,55,.3));animation:ftf 4s ease-in-out infinite;"></div>')
content.append(section(
    [column([htmlw(cine)], align="center")],
    bg_color=LOWEST, min_h=460, content_pos="middle", pad=(0,0,0,0),
))

# 10. SPECS
content.append(section(
    [column([
        image(BASE+"TAP-Logo@4x.png", width=40),
        image(BASE+"Specs.png", width=80),
    ], align="center")],
    bg_color=LOWEST, pad=(60,64,60,64),
))

# 11. RADAR
r1 = ('<div style="position:relative;overflow:hidden;border:1px solid '+OUTV+';">'
      '<div style="position:absolute;inset:0;background:url(\''+BASE+'IMG_3706.jpg\') center/cover;opacity:.5;"></div>'
      '<img src="'+BASE+'spider1B@2x.png" style="position:relative;z-index:1;max-width:100%;" alt="vs Extreme Contact Force"></div>')
r2 = ('<div style="position:relative;overflow:hidden;border:1px solid '+OUTV+';">'
      '<div style="position:absolute;inset:0;background:url(\''+BASE+'IMG_4130.jpg\') center/cover;opacity:.5;"></div>'
      '<img src="'+BASE+'spider2B@2x.png" style="position:relative;z-index:1;max-width:100%;" alt="vs Hoosier R7"></div>')
content.append(section(
    [ column([htmlw(r1)], size=50), column([htmlw(r2)], size=50) ],
    bg_color=BG, pad=(80,64,80,64),
))

# 12. H-DNA
content.append(section(
    [ column([image(BASE+"HDNA-white.png", width=80)], size=40),
      column([
        heading("Hoosier DNA", size=48, color=ONS),
        textw("<p>Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing "
              "excellence and relentless performance. Ignite your passion, empower your pride and drive your "
              "success as you conquer life on and off the track.</p>"),
      ], size=60) ],
    bg_color=BG, pad=(80,64,80,64),
))

# 13. TOTAL DOMINANCE
content.append(section(
    [column([
        heading("Total Dominance Plan", size=36, color=ONS),
        textw("<p>Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance "
              "tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology "
              "and backed by independent testing and expert endorsements, all Hoosier tires promises superior "
              "performance on every drive. Choose the Total Dominance Plan and elevate your driving experience to the next level.</p>", size=16),
    ])],
    bg_color=BG, pad=(80,64,80,64), border_top=OUTV,
))

# 14. PRODUCT TABLE
content.append(section(
    [column([htmlw(table_html)])],
    bg_color=BG, pad=(0,0,0,0),
))

# 15. RESOURCES
content.append(section(
    [column([heading("TrackAttack Pro Resources", size=48, color=ONS, align="center")], align="center")],
    bg_image=BASE+"racetrack_camera_03.jpg", bg_color=LOWEST, pad=(30,64,30,64), border_top=RED,
))
res_btn = lambda: ('<a href="#" style="display:inline-block;padding:10px 28px;border:2px solid '+OUT+';'
                   'font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;'
                   'text-transform:uppercase;color:'+ONS+';text-decoration:none;">Download</a>')
content.append(section(
    [ column([
        heading("Detailed Product Specifications", tag="h3", size=22, color=ONS, italic=False),
        textw('<p>TrackAttack Pro detailed product specifications can be downloaded here.</p>'
              '<p><em style="font-size:13px;color:'+OUT+';">NOTE: All measurements are subject to change upon official size release.</em></p>', size=15),
        htmlw(res_btn()),
      ], size=50),
      column([
        image(BASE+"LC3_2618.jpg", width=100),
        heading("Tire Care and Safety Guidelines", tag="h3", size=22, color=ONS, italic=False),
        textw('<p>Trackattack Pro detailed tire care procedures, best practices and safety guidelines.</p>', size=15),
        htmlw(res_btn()),
      ], size=50) ],
    bg_color=BG, pad=(60,64,60,64),
))

# 16. CONTACT FORM
def field(name, label, typ="text"):
    return ('<div style="margin-bottom:20px;"><label style="display:block;font-family:\'JetBrains Mono\',monospace;'
            'font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:'+SEC+';margin-bottom:8px;">'+label+'</label>'
            '<input type="'+typ+'" name="'+name+'" style="width:100%;padding:12px 16px;background:'+CONT+';border:none;'
            'border-bottom:2px solid '+OUTV+';color:'+ONS+';font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;'
            'direction:rtl;outline:none;"></div>')
form = ('<section id="contact" style="direction:rtl;">'
        '<h2 style="font-family:Anton;font-style:italic;font-size:48px;color:'+ONS+';text-align:center;margin-bottom:40px;">צרו קשר</h2>'
        '<form id="contactForm" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;">'
        '<div><p style="font-family:Anton;font-style:italic;font-size:24px;color:'+RED+';border-bottom:2px solid '+OUTV+';padding-bottom:12px;margin-bottom:24px;">פרטים אישיים</p>'
        + field("name","שם מלא") + field("email","אימייל","email") + field("phone","טלפון","tel") + '</div>'
        '<div><p style="font-family:Anton;font-style:italic;font-size:24px;color:'+RED+';border-bottom:2px solid '+OUTV+';padding-bottom:12px;margin-bottom:24px;">פרטי רכב</p>'
        + field("manufacturer","יצרן") + field("model","דגם") + field("year","שנת ייצור")
        + '<div style="margin-bottom:20px;"><label style="display:block;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:'+SEC+';margin-bottom:8px;">אני מעוניין בגדלים...</label>'
        '<div class="multiselect-wrapper" id="tireSizeSelect"><div class="multiselect-trigger" id="tireSizeTrigger" style="width:100%;padding:12px 16px;background:'+CONT+';border:none;border-bottom:2px solid '+OUTV+';color:'+OUT+';font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;direction:rtl;cursor:pointer;display:flex;align-items:center;justify-content:space-between;"><span class="trigger-text">בחרו גדלים</span><span class="arrow">&#9660;</span></div><div class="multiselect-dropdown" id="tireSizeDropdown"></div><div class="selected-tags" id="tireSizeTags"></div><input type="hidden" name="tire_sizes" id="tireSizesHidden"></div></div>'
        '<div style="margin-bottom:20px;"><label style="display:block;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:'+SEC+';margin-bottom:8px;">הערות רשות</label><textarea name="notes" style="width:100%;padding:12px 16px;background:'+CONT+';border:none;border-bottom:2px solid '+OUTV+';color:'+ONS+';font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;direction:rtl;outline:none;min-height:80px;"></textarea></div></div>'
        '<div style="grid-column:1/-1;text-align:center;"><button type="submit" style="width:100%;padding:16px 40px;background:'+RED+';color:#fffaf9;border:none;cursor:pointer;font-family:Anton;font-style:italic;font-size:24px;text-transform:uppercase;">שלח</button><div id="formNotice" style="display:none;padding:16px;margin-top:16px;"></div></div>'
        '</form></section>')
content.append(section(
    [column([htmlw(form)])],
    bg_color=CLOW, pad=(80,64,80,64), border_top=RED,
))

# ── wrap as Elementor template ──
template = {
    "version": "0.4",
    "title": "TrackAttack Pro",
    "type": "page",
    "content": content,
    "page_settings": {
        "background_background": "classic",
        "background_color": BG,
    },
}

out = os.path.join(ROOT, "wp-theme", "trackattack-elementor-template.json")
with open(out, "w") as f:
    json.dump(template, f, ensure_ascii=False)
print("Wrote", out)
print("Sections:", len(content))
print("Size:", round(os.path.getsize(out)/1024, 1), "KB")
