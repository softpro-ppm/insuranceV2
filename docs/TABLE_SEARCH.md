# Universal Table Search Documentation

## Overview
This project now includes a universal table search functionality that automatically adds search capabilities to all data tables across the application.

## Features

### ✅ Automatic Detection
- Automatically detects all `<table>` elements in the application
- Applies search functionality to tables with the `searchable-table` class
- Skips tables with the `no-search` class

### ✅ Smart Filtering
- **Real-time search**: Filters table rows as you type
- **Case-insensitive**: Search works regardless of letter case
- **Multi-column search**: Searches across all columns in the table
- **No page reload**: Pure client-side JavaScript filtering

### ✅ User Experience
- Search input box with search icon
- Clear button to reset search
- Results counter showing "X of Y records"
- "No matching results" message when no rows match
- Smooth animations during filtering

## Implementation

### Automatic Application
The search functionality is automatically applied to:
- All tables in DataTable components (policies, customers, agents)
- Dashboard tables (pending renewals)
- Renewals table
- Home page recent policies table

### Manual Application
To add search to any table:

```html
<!-- Add the searchable-table class -->
<table class="table searchable-table">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data 1</td>
            <td>Data 2</td>
        </tr>
    </tbody>
</table>
```

### Excluding Tables
To exclude a table from search functionality:

```html
<!-- Add the no-search class -->
<table class="table no-search">
    <!-- Table content -->
</table>
```

## Technical Details

### Classes Used
- `.searchable-table` - Enables search functionality
- `.no-search` - Disables search functionality
- `.table-search-box` - The search input element
- `.table-search-clear` - The clear button
- `.table-no-results` - The "no results" row

### JavaScript Functions
- `initializeTableSearch()` - Main initialization function
- `bindTableSearchEvents()` - Binds search and clear events
- `filterTable(tableId, searchTerm)` - Core filtering logic

### CSS Styling
- Search wrapper with light background
- Bootstrap-compatible styling
- Smooth transitions during filtering
- Responsive design

## Usage Examples

### Basic Search
1. Navigate to any page with data tables (Policies, Customers, Agents)
2. Type in the search box above the table
3. Watch as rows are filtered in real-time
4. Use the clear button (X) to reset the search

### Search Tips
- Search works across all columns
- Try partial matches (e.g., "john" will find "John Doe")
- Search phone numbers, email addresses, policy numbers, etc.
- Case doesn't matter ("JOHN" = "john" = "John")

## Browser Compatibility
- Works with all modern browsers
- Requires JavaScript enabled
- Uses jQuery (already included in the project)

## Performance
- Client-side filtering (no server requests)
- Efficient DOM manipulation
- Handles large tables (tested with 100+ rows)
- Minimal impact on page load

## Customization

### Search Placeholder
The search placeholder is automatically set to "Search in table..." but can be customized by modifying the JavaScript in the layout file.

### Styling
All styles are defined in the main layout file and can be customized by modifying the CSS variables or adding custom styles.

### Behavior
Search behavior can be modified by editing the `filterTable()` function in the layout file.

## Troubleshooting

### Search Box Not Appearing
- Check if the table has the `searchable-table` class
- Ensure the table has a `<tbody>` with rows
- Verify JavaScript is enabled

### Search Not Working
- Check browser console for JavaScript errors
- Ensure jQuery is loaded
- Verify the table structure is valid HTML

### Performance Issues
- For very large tables (1000+ rows), consider server-side filtering
- Check if there are console errors slowing down the page
