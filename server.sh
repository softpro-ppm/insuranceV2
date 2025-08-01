#!/bin/bash

# Insurance Management System Server Startup Script
# This script ensures the PHP development server is always running

PROJECT_DIR="/Users/rajesh/Documents/GitHub/insuranceV2"
SERVER_PORT="8000"
PID_FILE="$PROJECT_DIR/server.pid"

# Function to check if server is running
is_server_running() {
    if [ -f "$PID_FILE" ]; then
        local pid=$(cat "$PID_FILE")
        if ps -p $pid > /dev/null 2>&1; then
            return 0
        else
            rm -f "$PID_FILE"
            return 1
        fi
    else
        return 1
    fi
}

# Function to start the server
start_server() {
    if is_server_running; then
        echo "Server is already running on localhost:$SERVER_PORT"
        return 0
    fi
    
    echo "Starting Insurance Management System server on localhost:$SERVER_PORT..."
    cd "$PROJECT_DIR"
    
    # Start PHP development server in background
    nohup php -S localhost:$SERVER_PORT > server.log 2>&1 &
    local server_pid=$!
    
    # Save PID to file
    echo $server_pid > "$PID_FILE"
    
    # Wait a moment and check if server started successfully
    sleep 2
    if is_server_running; then
        echo "✅ Server started successfully!"
        echo "🌐 Access your application at: http://localhost:$SERVER_PORT"
        echo "📋 Server PID: $server_pid"
        echo "📝 Server logs: $PROJECT_DIR/server.log"
        return 0
    else
        echo "❌ Failed to start server"
        return 1
    fi
}

# Function to stop the server
stop_server() {
    if is_server_running; then
        local pid=$(cat "$PID_FILE")
        echo "Stopping server (PID: $pid)..."
        kill $pid
        rm -f "$PID_FILE"
        echo "✅ Server stopped successfully"
    else
        echo "Server is not running"
    fi
}

# Function to restart the server
restart_server() {
    stop_server
    sleep 1
    start_server
}

# Function to check server status
status_server() {
    if is_server_running; then
        local pid=$(cat "$PID_FILE")
        echo "✅ Server is running on localhost:$SERVER_PORT (PID: $pid)"
        echo "🌐 Access URL: http://localhost:$SERVER_PORT"
    else
        echo "❌ Server is not running"
    fi
}

# Function to monitor and auto-restart server
monitor_server() {
    echo "Starting server monitor..."
    while true; do
        if ! is_server_running; then
            echo "$(date): Server not running, attempting to restart..."
            start_server
        fi
        sleep 30  # Check every 30 seconds
    done
}

# Function to show server logs
show_logs() {
    if [ -f "$PROJECT_DIR/server.log" ]; then
        tail -f "$PROJECT_DIR/server.log"
    else
        echo "No log file found"
    fi
}

# Main script logic
case "$1" in
    start)
        start_server
        ;;
    stop)
        stop_server
        ;;
    restart)
        restart_server
        ;;
    status)
        status_server
        ;;
    monitor)
        monitor_server
        ;;
    logs)
        show_logs
        ;;
    *)
        echo "Usage: $0 {start|stop|restart|status|monitor|logs}"
        echo ""
        echo "Commands:"
        echo "  start   - Start the server"
        echo "  stop    - Stop the server"
        echo "  restart - Restart the server"
        echo "  status  - Check server status"
        echo "  monitor - Monitor and auto-restart server"
        echo "  logs    - Show server logs"
        echo ""
        echo "Example: $0 start"
        exit 1
        ;;
esac
