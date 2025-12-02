# GitHub Webhook Setup Guide for Packagist Auto-Update

This guide will help you set up automatic updates between your GitHub repository and Packagist, so whenever you push a new tag/release, Packagist automatically updates.

---

## Prerequisites

✅ Your package is submitted to Packagist  
✅ You have admin access to the GitHub repository  
✅ Repository: https://github.com/naim886/imgenerate-laravel-faker

---

## Step-by-Step Setup

### Step 1: Go to Your GitHub Repository Settings

1. Open your browser and go to:
   ```
   https://github.com/naim886/imgenerate-laravel-faker
   ```

2. Click on **"Settings"** tab (top right of the repository page)
   - If you don't see Settings, make sure you're logged in and have admin access

---

### Step 2: Navigate to Webhooks

1. In the left sidebar, scroll down and click **"Webhooks"**
   
2. Click the **"Add webhook"** button (green button on the right)

3. GitHub may ask for your password - enter it to confirm

---

### Step 3: Configure the Webhook

Fill in the webhook form with these exact values:

#### **Payload URL**
```
https://packagist.org/api/github?username=naim886
```
⚠️ **Important:** Replace `naim886` with your Packagist username if different

#### **Content type**
Select: `application/json`

#### **Secret**
Leave this **empty** (not required for Packagist)

#### **SSL verification**
Keep the default: ✅ **Enable SSL verification**

#### **Which events would you like to trigger this webhook?**
Select: 🔘 **Just the push event**

This is the default and correct option. Packagist will check for new tags when you push.

#### **Active**
Make sure the checkbox is ✅ **checked**

---

### Step 4: Add Webhook

1. Scroll down and click the green **"Add webhook"** button

2. You'll see a success message and be redirected to the webhooks list

3. Your new webhook will appear with a checkmark ✅ if successful

---

### Step 5: Test the Webhook (Optional but Recommended)

1. Click on the webhook you just created

2. Scroll down to **"Recent Deliveries"**

3. Click **"Redeliver"** on any delivery to test it

4. Check the response:
   - **200 OK** = ✅ Working perfectly
   - **4xx/5xx errors** = ❌ Something wrong (check URL)

---

## Webhook Configuration Summary

```yaml
Payload URL: https://packagist.org/api/github?username=naim886
Content type: application/json
Secret: (leave empty)
SSL verification: Enabled
Events: Just the push event
Active: Yes (checked)
```

---

## How It Works

### When You Push a New Tag:

```bash
git tag -a v1.0.2 -m "New release"
git push origin v1.0.2
```

**What Happens Automatically:**

1. 🚀 **You push tag** to GitHub
2. 📡 **GitHub sends webhook** to Packagist
3. 🔄 **Packagist receives webhook** and checks repository
4. 📦 **Packagist updates package** with new version
5. ✅ **Users can install** new version immediately

**Timeline:** Usually completes in **1-5 minutes**

---

## Verify Webhook is Working

### Method 1: Check Webhook Status on GitHub

1. Go to: https://github.com/naim886/imgenerate-laravel-faker/settings/hooks
2. Click on your Packagist webhook
3. Look for a green checkmark ✅ next to recent deliveries
4. Click on a delivery to see the response from Packagist

### Method 2: Check on Packagist

1. Go to: https://packagist.org/packages/naim886/imgenerate-laravel-faker
2. After pushing a new tag, wait 2-5 minutes
3. Refresh the Packagist page
4. You should see the new version listed

### Method 3: Test with a New Tag

```bash
# Create a test tag
git tag -a v1.0.2-test -m "Testing webhook"
git push origin v1.0.2-test

# Wait 2-5 minutes, then check Packagist
# If it appears, webhook is working!

# Delete test tag if you want
git tag -d v1.0.2-test
git push origin :refs/tags/v1.0.2-test
```

---

## Troubleshooting

### ❌ Webhook Shows Red X or Errors

**Problem:** Packagist returns 404 or error

**Solution:**
1. Check the URL is exactly: `https://packagist.org/api/github?username=naim886`
2. Verify your Packagist username is correct
3. Make sure your package is actually submitted to Packagist first

---

### ❌ New Version Not Appearing on Packagist

**Possible Causes:**

1. **Webhook not triggered**
   - Check Recent Deliveries on GitHub webhook page
   - If no deliveries, webhook might be inactive

2. **Tag not pushed properly**
   ```bash
   # List all tags
   git tag -l
   
   # Push specific tag
   git push origin v1.0.1
   ```

3. **Packagist caching**
   - Wait 5-10 minutes
   - Or manually click "Update" button on Packagist

---

### ❌ Package Not Found on Packagist

**Solution:** Submit your package first!

1. Go to: https://packagist.org/packages/submit
2. Enter: `https://github.com/naim886/imgenerate-laravel-faker`
3. Click Submit
4. Then set up webhook

---

## Manual Update (Fallback)

If webhook is not working, you can always manually update:

1. Go to: https://packagist.org/packages/naim886/imgenerate-laravel-faker
2. Click the **"Update"** button
3. Packagist will fetch latest tags from GitHub

---

## Security Notes

### Why No Secret?

- Packagist webhook doesn't require a secret token
- GitHub's SSL verification provides security
- The webhook only triggers Packagist to check your public GitHub repository

### Webhook URL Format

The username in the URL is just for organization:
```
https://packagist.org/api/github?username=YOUR_PACKAGIST_USERNAME
```

This helps Packagist know which account to update packages for.

---

## Additional Webhooks (Optional)

You can add webhooks for other services too:

### Travis CI (Continuous Integration)
```
https://notify.travis-ci.org
```

### Slack (Notifications)
```
https://hooks.slack.com/services/YOUR/WEBHOOK/URL
```

### Discord (Notifications)
```
https://discord.com/api/webhooks/YOUR_WEBHOOK_URL
```

---

## FAQ

### Q: Do I need a webhook for each package?
**A:** No! One webhook per repository. If you have multiple packages in one repo, one webhook updates all.

### Q: Can I use the same webhook for multiple repositories?
**A:** No, you need to set up a webhook in each repository's settings.

### Q: What if I change my Packagist username?
**A:** Update the webhook URL with your new username.

### Q: Will this work with private repositories?
**A:** Packagist.org only works with public repositories. For private packages, use Private Packagist (paid service).

### Q: How do I remove the webhook?
**A:** Go to Settings → Webhooks → Click webhook → Delete webhook (at bottom)

---

## Quick Reference Card

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
 WEBHOOK QUICK SETUP
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

 Repository URL:
 https://github.com/naim886/imgenerate-laravel-faker/settings/hooks

 Payload URL:
 https://packagist.org/api/github?username=naim886

 Content Type: application/json
 Events: Just the push event
 Active: ✓ Yes

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

---

## Need Help?

- **GitHub Webhooks Documentation:** https://docs.github.com/en/webhooks
- **Packagist Documentation:** https://packagist.org/about
- **Package Page:** https://packagist.org/packages/naim886/imgenerate-laravel-faker

---

## Summary

✅ **Setup Time:** 2-3 minutes  
✅ **Difficulty:** Easy  
✅ **Benefits:** Automatic updates, no manual work  
✅ **Cost:** Free  

Once set up, you'll never need to manually update Packagist again! 🎉

