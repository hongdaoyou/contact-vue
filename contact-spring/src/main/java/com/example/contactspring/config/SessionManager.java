package com.example.contactspring.config;

import org.springframework.web.context.request.*;

import jakarta.servlet.http.*;

public class SessionManager {
    HttpSession session = null;

    public SessionManager() {
        // ServletRequestAttributes attr = (ServletRequestAttributes)
        // RequestContextHolder.currentRequestAttributes();
        // // this.session = attr.getRequest().getSession(true);

        // HttpServletRequest request = attr.getRequest();
        // this.session session = request.getSession(true);

    }

    // 设置,属性
    public void setAttribute(String key, Object value) {
        // this.session.setAttribute(key, value);
    }

    // 获取属性
    public Object getAttribute(String key) {
        // return this.session.getAttribute(key);
        return null;

    }

}
