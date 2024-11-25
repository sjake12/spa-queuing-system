import { Search } from 'lucide-react';

export default function SearchBar() {
    return (
        <div className="flex items-center shadow-md p-2 rounded-md mb-6 border-[1px]" >
            <input
                type="text"
                placeholder="Search..."
                className="border-none flex-grow p-2 rounded-l-md"
            />
            <button className="p-2 rounded-r-md" >
                <Search className="w-5 h-5" />
            </button >
        </div >
    )
}
