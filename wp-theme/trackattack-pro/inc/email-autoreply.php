<?php
/**
 * Auto-reply email template — early-bird pricing.
 * Called from functions.php with $name_esc and $price_rows already set.
 * Returns HTML string.
 */
ob_start();
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#0e0e0e;font-family:Arial,Helvetica,sans-serif;direction:rtl;text-align:right;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#0e0e0e;">
<tr><td align="center" style="padding:32px 16px;">
<table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#131313;border-radius:12px;overflow:hidden;border:1px solid #5d3f3e;">

  <!-- Header bar -->
  <tr><td style="background:linear-gradient(135deg,#8B3FD4,#6A1FB0);padding:20px 32px;">
    <p style="margin:0;color:#fff;font-size:22px;font-weight:bold;letter-spacing:1px;">TrackAttack Pro</p>
    <p style="margin:4px 0 0;color:rgba(255,255,255,.75);font-size:13px;">מחיר מוקדם — הראשונים על המסלול</p>
  </td></tr>

  <!-- Body -->
  <tr><td style="padding:32px;color:#e5e2e1;font-size:16px;line-height:1.8;">

    <p style="margin:0 0 20px;">שלום <strong><?php echo $name_esc; ?></strong>,</p>

    <p style="margin:0 0 20px;">כיף לראות שגם אתה מחכה ל-TrackAttack Pro כמונו.</p>

    <p style="margin:0 0 20px;">השקענו המון כדי להביא צמיג שמספק את השילוב המושלם בין פידבק מטורף מההגה לבין אחיזה קשוחה ופנומנלית בפניות ובכלל – בדיוק מה שצריך כדי לגרד לפחות עוד כמה עשיריות שנייה מהלפ-טיים שלך.</p>

    <p style="margin:0 0 24px;">כמי שנרשם בדף הנחיתה, מגיע לך ליהנות ממחיר של &#x201C;הראשונים על המסלול&#x201D;. הנה ההצעה שלך:</p>

    <!-- Price table -->
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#1c1b1b;border-radius:8px;border:1px solid #3a3939;margin-bottom:28px;">
    <tr><td style="padding:16px 20px;">
      <table width="100%" cellpadding="0" cellspacing="0" style="direction:rtl;text-align:right;">
        <?php echo $price_rows; ?>
      </table>
    </td></tr>
    </table>

    <p style="margin:0 0 20px;font-size:13px;color:#9e9e9e;border-right:3px solid #8B3FD4;padding-right:12px;">
      <strong>האותיות הקטנות (והטובות):</strong> ההטבה הזו ניתנת אך ורק למזמינים מראש לפני הגעת המשלוח הרשמי והמלאי להטבה הזו מוגבל בהחלט.
    </p>

    <p style="margin:0 0 28px;">ממש חבל לפספס את המחיר הזה ואז לרכוש במחיר מלא....</p>

    <p style="margin:0 0 8px;font-weight:bold;">רוצה לשריין את הסט שלך?</p>
    <p style="margin:0 0 32px;">השב למייל זה עם המילה &#x201C;מעוניין&#x201D; או שלח לנו הודעה ישירה לוואטסאפ כאן: <a href="[קישור לוואטסאפ]" style="color:#c084fc;">[וואטסאפ]</a></p>

    <p style="margin:0 0 4px;">נתראה על האספלט,</p>
    <p style="margin:0;color:#c084fc;font-weight:bold;">צוות PitStop / TrackAttack Pro</p>

  </td></tr>

  <!-- Footer -->
  <tr><td style="padding:16px 32px;background:#0e0e0e;text-align:center;font-size:11px;color:#555;">
    TrackAttack Pro &nbsp;|&nbsp; USDOT Street Legal
  </td></tr>

</table>
</td></tr>
</table>
</body>
</html>
<?php
return ob_get_clean();
