//
//  AppDelegate.swift
//  Flow.IOS
//
//  Created by yuhanxiao on 5/19/17.
//  Copyright © 2017 yuhanxiao. All rights reserved.
//

import UIKit
import UserNotifications

extension Data {
    var hexString: String {
        return withUnsafeBytes {(bytes: UnsafePointer<UInt8>) -> String in
            let buffer = UnsafeBufferPointer(start: bytes, count: count)
            return buffer.map {String(format: "%02hhx", $0)}.reduce("", { $0 + $1 })
        }
    }
}
extension Notification.Name {
    static let AppDidReceivedRemoteNotificationDeviceToken = Notification.Name(rawValue: "com.NSGE.Atthis.AppDidReceivedRemoteNotificationDeviceToken")
}

extension Notification {
    struct Key {
        static let AppDidReceivedRemoteNotificationDeviceTokenKey = "token"
    }
}

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate, UNUserNotificationCenterDelegate {

    var window: UIWindow?


    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {
        if #available(iOS 10.0, *) {
            UNUserNotificationCenter.current().requestAuthorization(options: [.alert, .sound, .badge]) {
                granted, error in
                if granted {
                    UIApplication.shared.registerForRemoteNotifications()
                    print("success")
                }
            }
        } else {
            // Fallback on earlier versions
            if #available(iOS 8.0, *) {
                let seetings = UIUserNotificationSettings(types: [.alert,.badge,.sound], categories: nil)
                application.registerUserNotificationSettings(seetings)
            } else {
                // Fallback on earlier versions
                application.registerForRemoteNotifications(matching: [.alert,.badge,.sound])
            }
        }
        
        return true
    }
    
    // AppDelegate.swift
    func application(_ application: UIApplication, didRegisterForRemoteNotificationsWithDeviceToken deviceToken: Data) {
        let tokenString = deviceToken.hexString
        UserDefaults.standard.set(tokenString, forKey: "push-token")
        NotificationCenter.default.post(name: .AppDidReceivedRemoteNotificationDeviceToken, object: nil, userInfo: [Notification.Key.AppDidReceivedRemoteNotificationDeviceTokenKey: tokenString])
        
        print("Get Push token: \(tokenString)")
    }
    
    func application(_ application: UIApplication, didFailToRegisterForRemoteNotificationsWithError error: Error) {
        UserDefaults.standard.set("", forKey: "push-token")
        print(error)
    }
    // iOS 6
    func application(_ application: UIApplication, didReceiveRemoteNotification userInfo: [AnyHashable : Any]) {
        print(userInfo)
    }
    
    // iOS 7
    func application(_ application: UIApplication, didReceiveRemoteNotification userInfo: [AnyHashable : Any], fetchCompletionHandler completionHandler: @escaping (UIBackgroundFetchResult) -> Void) {
        completionHandler(.newData)
    }
    
    // iOS 10收到通知
    @available(iOS 10.0, *)
    func userNotificationCenter(_ center: UNUserNotificationCenter, willPresent notification: UNNotification, withCompletionHandler completionHandler: @escaping (UNNotificationPresentationOptions) -> Void) {
        let userInfo = notification.request.content.userInfo
        
        if notification.request.trigger!.isKind(of: UNPushNotificationTrigger.self) {
            print("远程通知:\(userInfo)")
        } else {
            print("本地通知")
        }
        completionHandler([.alert,.badge,.sound])
    }
    
    // 通知的点击事件
    @available(iOS 10.0, *)
    func userNotificationCenter(_ center: UNUserNotificationCenter, didReceive response: UNNotificationResponse, withCompletionHandler completionHandler: @escaping () -> Void) {
        let userInfo = response.notification.request.content.userInfo
        
        if response.notification.request.trigger!.isKind(of: UNPushNotificationTrigger.self) {
            print("远程通知:\(userInfo)")
        } else {
            print("本地通知")
        }
        completionHandler()
    }
    
    func applicationWillResignActive(_ application: UIApplication) {
        // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
        // Use this method to pause ongoing tasks, disable timers, and invalidate graphics rendering callbacks. Games should use this method to pause the game.
    }

    func applicationDidEnterBackground(_ application: UIApplication) {
        // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
        // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
    }

    func applicationWillEnterForeground(_ application: UIApplication) {
        // Called as part of the transition from the background to the active state; here you can undo many of the changes made on entering the background.
    }

    func applicationDidBecomeActive(_ application: UIApplication) {
        // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
    }

    func applicationWillTerminate(_ application: UIApplication) {
        // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
    }


}

