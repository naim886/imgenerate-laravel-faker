# 🚀 Packagist Webhook Setup - One-Page Cheat Sheet

## ⚡ Quick Setup (Copy & Paste)

### 1️⃣ Go to GitHub Webhooks
```
https://github.com/naim886/imgenerate-laravel-faker/settings/hooks
```

### 2️⃣ Click "Add webhook"

### 3️⃣ Fill in These Values:

**Payload URL:**
```
https://packagist.org/api/github?username=naim886
```

**Content type:**
```
application/json
```

**Secret:**
```
(leave empty)
```

**Which events:**
```
✓ Just the push event
```

**Active:**
```
✓ Checked
```

### 4️⃣ Click "Add webhook" ✅

---

## ✅ Verification

**Check webhook status:**
```
https://github.com/naim886/imgenerate-laravel-faker/settings/hooks
```

**Should see:**
- ✅ Green checkmark
- ✅ Status: 200 OK
- ✅ Recent deliveries listed

---

## 🎯 How to Use

### Every time you release a new version:

```bash
# 1. Update your code
git add .
git commit -m "Add new feature"

# 2. Create and push tag
git tag -a v1.0.2 -m "Release v1.0.2"
git push origin main
git push origin v1.0.2

# 3. Wait 1-5 minutes
# Packagist updates automatically! 🎉
```

**No need to:**
- ❌ Log into Packagist
- ❌ Click "Update" button
- ❌ Do anything manually

---

## 🔍 Troubleshooting

### Problem: 404 Error
**Solution:** Submit package to Packagist first
```
https://packagist.org/packages/submit
```

### Problem: No deliveries
**Solution:** Check "Active" is checked and push a tag

### Problem: Wrong URL
**Solution:** Use YOUR Packagist username in URL:
```
https://packagist.org/api/github?username=YOUR_USERNAME
```

---

## 📱 Quick Links

- **Setup Webhook:** https://github.com/naim886/imgenerate-laravel-faker/settings/hooks
- **Your Package:** https://packagist.org/packages/naim886/imgenerate-laravel-faker
- **Submit Package:** https://packagist.org/packages/submit

---

## ⏰ Timeline

| Action | Time |
|--------|------|
| Setup webhook | 2 min |
| Push new tag | 10 sec |
| Packagist updates | 1-5 min |
| **Total** | **~5 min one-time** |

---

## ✨ That's It!

One-time setup = Lifetime automation! 🚀

